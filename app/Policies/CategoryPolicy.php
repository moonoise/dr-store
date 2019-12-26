<?php

namespace App\Policies;

use App\User;
use App\Categories;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the categories.
     *
     * @param  \App\User  $user
     * @param  \App\Categories  $categories
     * @return mixed
     */
    public function view(User $user, Categories $categories)
    {
        //
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the categories.
     *
     * @param  \App\User  $user
     * @param  \App\Categories  $categories
     * @return mixed
     */
    public function update(User $user, Categories $categories)
    {
        //
    }

    /**
     * Determine whether the user can delete the categories.
     *
     * @param  \App\User  $user
     * @param  \App\Categories  $categories
     * @return mixed
     */
    public function delete(Categories $categories, Articles $articles)
    {


    }

    /**
     * Determine whether the user can restore the categories.
     *
     * @param  \App\User  $user
     * @param  \App\Categories  $categories
     * @return mixed
     */
    public function restore(User $user, Categories $categories)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the categories.
     *
     * @param  \App\User  $user
     * @param  \App\Categories  $categories
     * @return mixed
     */
    public function forceDelete(User $user, Categories $categories)
    {
        //
    }
}
