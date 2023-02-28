<?php

namespace App\Models;

use App\Utils\BaseModel;

use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facility extends BaseModel
{
    use HasFactory, SoftDeletes, GeneratesUiud;

    protected $table = 'facilities';


    // protected $guard_name = 'api';
}
