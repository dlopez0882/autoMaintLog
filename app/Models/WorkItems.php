<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkItems extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_date',
        'vehicle_id',
        'mileage',
        'service_summary',
        'cost',
        'technician',
    ];
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
