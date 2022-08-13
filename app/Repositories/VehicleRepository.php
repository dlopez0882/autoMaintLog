<?php
 
namespace App\Repositories;
 
use App\Models\User;
use App\Models\Vehicle;
 
class VehicleRepository
{
    /**
     * Get all of the vehicles for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->vehicles()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    /**
     * Get a single vehicle for a given user.
     *
     * @param  User  $user
     * @param  Vehicle  $vehicle
     */
    public function forUserSingle(User $user, Vehicle $vehicle)
    {
        return $user->vehicles()
                    ->where('id', $vehicle->id)
                    ->firstOrFail();
    }
}

