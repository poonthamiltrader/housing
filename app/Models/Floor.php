<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $table = 'floor_details';

    public function subfloor()
    {
        return $this->hasMany(Subfloor::class);
    }
    public function projectdetails()
    {
        return $this->belongsTo(Projectdetails::class,'project_id');
    }
}
