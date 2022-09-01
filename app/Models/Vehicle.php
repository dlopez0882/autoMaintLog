<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'year',
        'make',
        'model',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workItems()
    {
        return $this-hasMany(WorkItems::class);
    }
}
