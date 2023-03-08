<?php

namespace App\Models;

use App\Utils\GeneratesUiud;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, GeneratesUiud;

    protected $table = 'users';
    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $dates = ['current_login_at', 'last_login_at'];
}
