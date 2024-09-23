<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPropertyProfile extends Model
{
    use HasFactory;
    protected $table='postproperty_profile';

    public function postproperty()
    {
        return $this->hasMany(PostProperty::class);
    }
}
