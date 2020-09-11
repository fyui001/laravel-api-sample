<?php

namespace App\Models;

use App\Models\Model as AppModel;
use App\Models\User;

class Photo extends AppModel
{

    protected $table = 'photos';
    protected $primaryKey = 'id';

    const LOCAL_TMP_IMAGE_PATH = 'app/private/photos/temporary_image_location/';
    const LOCAL_PUBLIC_IMAGE_PATH = 'app/public/photos/';

    protected $fillable = [
        'title',
        'content',
        'image_url',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
