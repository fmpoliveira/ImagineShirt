<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
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

    public function viewPrivate(User $user): bool
    {
        // A user can only see his images
        return $user->user_type === 'C';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->user_type === 'C';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->user_type === 'A' || $user->user_type === 'E';
    }

    public function getReceipt(User $user, Order $order): bool
    {
        return $user->customer->id === $order->customer_id || $user->user_type === 'A';
    }
}
