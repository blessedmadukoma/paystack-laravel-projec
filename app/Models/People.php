<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $table = 'people';

    public function bank() {
        return $this->hasOne('App\Models\Bank', 'people_id');
    }
}
