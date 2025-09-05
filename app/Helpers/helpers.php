<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('canSuperAdminOr')) {
    function canSuperAdminOr(string $permission): bool
    {
        $user = Auth::user();
        if (! $user) {
            return false;
        }

        return $user->hasRole('super-admin') || $user->can($permission);
    }
}
