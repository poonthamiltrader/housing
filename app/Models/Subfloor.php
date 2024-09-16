<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subfloor extends Model
{
    use HasFactory;
    protected $table = 'subfloor_details';

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

}
