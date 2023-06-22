<?php

namespace App\Policies;

use App\Models\TshirtImage;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TshirtImagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TshirtImage $tshirtImage): bool
    {
        return $user->user_type === 'A';
    }

    public function viewAdmin(User $user): bool
    {
        return $user->user_type === 'A';
    }

    public function viewAdminAndEmployee(User $user): bool
    {
        return $user->user_type === 'A' || $user->user_type === 'E';
    }

    public function viewCustomer(User $user): bool
    {
        return $user->user_type === 'C';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        // When anonymous, redirects to login page (verify TshirtImage controller create)
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TshirtImage $tshirtImage): bool
    {
        // Only admin can update images
        return $user->user_type === 'A';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TshirtImage $tshirtImage): bool
    {
        // Only admin can delete images
        return $user->user_type === 'A';
    }

    public function viewPrivateImages(User $user, TshirtImage $tshirtImage): bool
    {
        // A user can only see his images
        return $user->id === $tshirtImage->customer_id;
    }

    public function updatePrivate(User $user, TshirtImage $tshirtImage): bool
    {
        // A user can only update his images
        return $user->id === $tshirtImage->customer_id;
    }

    public function deletePrivate(User $user, TshirtImage $tshirtImage): bool
    {
        // Only admin can delete images
        return $user->id === $tshirtImage->customer_id;
    }
}
