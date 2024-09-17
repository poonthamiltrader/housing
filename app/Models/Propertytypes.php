<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propertytypes extends Model
{
    use HasFactory;
    protected $table = 'property_types';

    public function projectdetails()
    {
        return $this->hasMany(Projectdetails::class);
    }
}
