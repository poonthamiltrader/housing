<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectamenities extends Model
{
    use HasFactory;
    protected $table = 'project_amenities';

    public function amenities()
    {
        return $this->belongsTo(Amenities::class);
    }
    public function projectdetails()
    {
        return $this->belongsTo(Projectdetails::class);
    }
}
