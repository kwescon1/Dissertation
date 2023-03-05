<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
}
