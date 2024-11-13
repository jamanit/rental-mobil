<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait InsertUserId
{
    protected static function bootInsertUserId()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->user_id = Auth::id();
            }
        });
    }
}
