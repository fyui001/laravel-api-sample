<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\PhotoServiceInterface;
use App\Models\Photo;
use App\Http\Requests\Photos\PhotoCreateRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class PhotoService implements PhotoServiceInterface
{

    public function getPhotoList(Request $request): LengthAwarePaginator {

        $photoList = Photo::where([
            'del_flg' => 0
        ])->orderBy('id', 'desc')
          ->paginate(10);

        foreach ($photoList as $key => $value) {
            $value->user = $value->user;
        }

        return $photoList;

    }

    public function createPhoto(PhotoCreateRequest $request): bool {

        $userId = Auth::guard('api')->user()->id;
        $dateTime = new \DateTime();
        $saveImageName = $dateTime->format('YmdHisv') . '.jpg';
        $originalImageName = $request->image->getClientOriginalName();

        $request->image->storeAs('private/photos/temporary_image_location/', $originalImageName);
        $uploadImagePath = storage_path(Photo::LOCAL_TMP_IMAGE_PATH) . $originalImageName;
        $saveTemporaryImagePath = storage_path(Photo::LOCAL_PUBLIC_IMAGE_PATH) . $saveImageName;

        try {
            DB::beginTransaction();

            if (!imageValidator($uploadImagePath, $saveTemporaryImagePath)) {
                throw new \Exception();
            }

            $imageUrl = Storage::disk('s3')->url('public/photos/' . $saveImageName);
            Storage::disk('s3')->putFileAs('public/photos/', $saveTemporaryImagePath, $saveImageName);

            Photo::create([
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'image_url' => $imageUrl,
                'user_id' => $userId,
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            DB::rollBack();
            return false;
        }
    }

}
