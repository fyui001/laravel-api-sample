<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\PhotoServiceInterface;
use App\Http\Requests\Photos\PhotoCreateRequest;
use App\Models\Photo;

class PhotosController
{

    protected $photoService;

    public function __construct(PhotoServiceInterface $photoService) {

        $this->photoService = $photoService;

    }

    public function index(Request $request): array {

        $photoList = $this->photoService->getPhotoList($request);

        if ($photoList->isEmpty()) {
            return [
                'status' => false,
                'msg' => '共有された写真はありません',
            ];
        }

        return [
            'status' => true,
            'data' => $photoList,
        ];

    }

    public function show(Photo $photo): array {

        if ($photo->del_flg) {
            return [
              'status' => false,
              'msg' => '共有された写真が見つかりませんでした',
            ];
        }

        $photo->user;
        return [
            'status' => true,
            'data' => $photo
        ];

    }

    public function create(PhotoCreateRequest $request): array {

        if (!$this->photoService->createPhoto($request)) {
            return [
                'status' => false,
                'msg' => '写真の投稿に失敗しました'
            ];
        }

        return [
            'status' => true,
            'msg' => '正常に投稿できました'
        ];
    }

}
