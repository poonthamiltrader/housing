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
    // public function builder()
    // {
    //     return $this->hasMany(Builder::class);
    // }
    public function floor()
    {
        return $this->hasMany(Floor::class, 'project_id');
    }
    public function projectamenities()
    {
        return $this->belongsTo(Projectamenities::class);
    }
    // public function projectbuilder()
    // {
    //     return $this->hasMany(Projectbuilder::class, 'project_id');
    // }
    public function propertytypes()
    {
        return $this->belongsTo(Propertytypes::class);
    }

}
