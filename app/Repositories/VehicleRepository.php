<?php
 
namespace App\Repositories;
 
use App\Models\User;
 
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
}

