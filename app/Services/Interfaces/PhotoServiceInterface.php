<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\Photos\PhotoCreateRequest;
use Illuminate\Pagination\LengthAwarePaginator;

interface PhotoServiceInterface
{
    public function getPhotoList(Request $request): LengthAwarePaginator;
    public function createPhoto(PhotoCreateRequest $request): bool;
}
