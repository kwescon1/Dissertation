<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory, GeneratesUiud;

    protected $table = 'conversations';
    protected $keyType = "string";
    protected $guarded = ['id'];
}
