<?php

namespace App\Models;

use App\Utils\BaseModel;
use App\Utils\GeneratesUiud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

<<<<<<< HEAD
class Residence extends BaseModel
=======
class Residence extends Model
>>>>>>> 7d89bbf48aee8bf4650e0ac8bf385371d42cc55e
{
    use HasFactory, SoftDeletes, GeneratesUiud;

    protected $table = 'residences';
<<<<<<< HEAD
=======
    protected $keyType = "string";
    protected $guarded = ['id'];
>>>>>>> 7d89bbf48aee8bf4650e0ac8bf385371d42cc55e

    public function client()
    {
        return $this->belongsTo(Client::class, 'residential_address_id');
    }
}
