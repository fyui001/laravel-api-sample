<?php

declare(strict_types=1);

if (!function_exists('imageValidator')) {

    /**
     * 画像ファイルのバリデーションと圧縮を行う
     *
     * @param string $imageFilePath
     * @param string $writeImagePath
     * @return bool
     */
    function imageValidator(string $imageFilePath, string $writeImagePath): bool {

        $allowImageFormat = [
            'PNG' => 1,
            'JPEG' => 1,
            'GIF' => 1
        ];

        try {
            $imagick = new \Imagick($imageFilePath);
            $imagick->stripImage();
            $imagick->setImageCompressionQuality(60);
            $imageFormat = $imagick->getImageFormat();

            if (!isset($allowImageFormat[$imageFormat]) || !$imagick->writeImage($writeImagePath)) {
                $imagick->destroy();
                throw new \ImagickException();
            }

            $imagick->destroy();
            return true;
        } catch (\ImagickException $e) {
            die($e->getMessage());
        }
    }

}
