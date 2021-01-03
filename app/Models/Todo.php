<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable= [
        'title',
        'completed',
        'description'
    ];

    // todo to steps relationship (1 to many)

    public function steps()
    {
        return  $this->hasMany(Step::class);
    }
}
