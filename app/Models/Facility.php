<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facility extends Model
{
    use HasFactory, SoftDeletes, GeneratesUiud;

    protected $table = 'facilities';
    protected $keyType = "string";
    protected $guarded = ['id'];
}
