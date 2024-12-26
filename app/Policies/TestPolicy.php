<?php

namespace App\Policies;

use App\Models\Test;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Test $test): bool
    {
        return false;
    }
    public function answertest(User $user): bool
    {
         return  $user->applier =="طالب";
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
            return $user->applier =="مُعلم";
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Test $test): bool
    {
        return $user->id ==$test->teacher_id && $user->applier =="مُعلم";
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user,Test $test): bool
    {
        return $user->id === $test->teacher_id && $user->applier === "مُعلم";
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Test $test): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Test $test): bool
    {
        return false;
    }
}
