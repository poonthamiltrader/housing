<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPropertyImages extends Model
{
    use HasFactory;
    protected $table='postproperty_images';

    public function postproperty()
    {
        return $this->hasMany(PostProperty::class);
    }

}
