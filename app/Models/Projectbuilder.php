<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectbuilder extends Model
{
    use HasFactory;
    protected $table = 'project_builder';

    public function builder()
    {
        return $this->belongsTo(Builder::class);
    }
    // public function projectdetails()
    // {
    //     return $this->hasMany(Projectdetails::class);
    // }
}
