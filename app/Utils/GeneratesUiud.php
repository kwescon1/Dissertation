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
            $model->setAttribute($model->getKeyName(), Uuid::uuid6());
        });
    }
}
