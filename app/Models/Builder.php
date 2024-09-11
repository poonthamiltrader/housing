<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Builder extends Model
{
    use HasFactory;
    protected $table = 'builder';
    public function projectdetails()
    {
        return $this->hasMany(Projectdetails::class);
    }
}
