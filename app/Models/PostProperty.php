<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostProperty extends Model
{
    use HasFactory;
    protected $table='post_property';

    public function propertytypes()
    {
        return $this->belongsTo(Propertytypes::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    // public function postproperty_images()
    // {
    //     return $this->belongsTo(PostPropertyImages::class);
    // }
    // public function postproperty_profile()
    // {
    //     return $this->belongsTo(PostPropertyProfile::class);
    // }

}
