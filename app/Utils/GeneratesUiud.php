<?php

namespace App\Utils;


use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

trait GeneratesUiud
{


    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->incrementing = false;
            $model->keyType = "string";
            $model->guarded = ['id'];
            $model->primaryKey = "id";
            // $model->guard_name = 'api';
            $model->setAttribute($model->getKeyName(), Uuid::uuid6());
        });
    }
}
