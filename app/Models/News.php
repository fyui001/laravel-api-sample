<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Model as AppModel;

class News extends AppModel
{
    protected $table = 'news';

    const STATUS_INVALID = 0;
    const STATUS_VALID = 1;

    public $fillable = [
        'title',
        'content',
        'status',
    ];

    public static function statuses(): array {
        return [
            self::STATUS_INVALID => '無効',
            self::STATUS_VALID => '有効',
        ];
    }

    public static function getStatusText($status = 0): string
    {
        $statuses = self::statuses();
        return !empty($statuses[$status]) ? $statuses[$status] : '';
    }
}
