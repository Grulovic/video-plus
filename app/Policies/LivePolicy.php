<?php

namespace App\Policies;

use App\Models\Live;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LivePolicy
{
    use HandlesAuthorization;

	public function before($user, $ability){
    	if($user->isAdmin() || $user->isEditor() ){
        	return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
         return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Live  $live
     * @return mixed
     */
    public function view(User $user, Live $live)
    {
         return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
         return $user->isAdmin() || $user->isEditor() ;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Live  $live
     * @return mixed
     */
    public function update(User $user, Live $live)
    {
         return $user->isAdmin() || $user->isEditor() ;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Live  $live
     * @return mixed
     */
    public function delete(User $user, Live $live)
    {
         return $user->isAdmin() || $user->isEditor() ;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Live  $live
     * @return mixed
     */
    public function restore(User $user, Live $live)
    {
         return $user->isAdmin() || $user->isEditor() ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Live  $live
     * @return mixed
     */
    public function forceDelete(User $user, Live $live)
    {
         return $user->isAdmin() || $user->isEditor() ;
    }
}
