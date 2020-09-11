<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    const STATUS_ACTIVE = 1;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = [
        'user_id',
        'password',
        'access_token',
        'name',
        'del_flg',
        'created_at',
        'updated_at'
    ];

    /**
     * 配列に含めたくない属性
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'access_token',
        'del_flg',
    ];
}
