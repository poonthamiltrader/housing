<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectdetails extends Model
{
    use HasFactory;
    protected $table = 'project_details';

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function builder()
    {
        return $this->belongsTo(Builder::class);
    }
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }
    public function projectamenities()
    {
        return $this->belongsTo(Projectamenities::class);
    }

}
