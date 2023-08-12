<?php

namespace App\Exceptions\File;

use RuntimeException;

class FailedUploadFileException extends RuntimeException
{
    public function report(): void
    {
    }

    public function render($request)
    {
        logs()->error($request);

        return response()->view(
            'error',
            ['error' => '画像のアップロードに失敗しました。時間を置いてからもう一度お試しください。'],
            500
        );
    }
}
