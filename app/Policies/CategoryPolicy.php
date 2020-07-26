<?php

namespace App\Policies;

use App\Product_category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any product_categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->is_admin == 0 && isset($user->shopId);
    }

    /**
     * Determine whether the user can view the product_category.
     *
     * @param  \App\User  $user
     * @param  \App\Product_category  $productCategory
     * @return mixed
     */
    public function view(User $user, Product_category $productCategory)
    {
        return $user->is_admin == 0;
    }

    /**
     * Determine whether the user can create product_categories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return isset($user->shopId);
    }

    /**
     * Determine whether the user can update the product_category.
     *
     * @param  \App\User  $user
     * @param  \App\Product_category  $productCategory
     * @return mixed
     */
    public function update(User $user, Product_category $productCategory)
    {
        return $user->shopId === $productCategory->shopId;
    }

    /**
     * Determine whether the user can delete the product_category.
     *
     * @param  \App\User  $user
     * @param  \App\Product_category  $productCategory
     * @return mixed
     */
    public function delete(User $user, Product_category $productCategory)
    {
        //
    }

    /**
     * Determine whether the user can restore the product_category.
     *
     * @param  \App\User  $user
     * @param  \App\Product_category  $productCategory
     * @return mixed
     */
    public function restore(User $user, Product_category $productCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product_category.
     *
     * @param  \App\User  $user
     * @param  \App\Product_category  $productCategory
     * @return mixed
     */
    public function forceDelete(User $user, Product_category $productCategory)
    {
        //
    }
}
