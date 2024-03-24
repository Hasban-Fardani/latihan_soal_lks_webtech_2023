<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
