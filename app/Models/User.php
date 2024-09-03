<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function history() {
        return $this->hasMany(History::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function videos() {
        return $this->hasMany(Video::class);
    }

    public function photos() {
        return $this->hasMany(Photo::class);
    }

    public function blocks() {
        return $this->hasMany(BlockedUser::class);
    }

	public function isAdmin(){
      return $this->role == "admin" ? true:false;
    }

    public function isEditor(){
        return $this->role == "editor" ? true:false;
    }

	public function isUser(){
      return $this->role == "user" ? true:false;
    }

    public function isBlocked(){
        $block_exists = BlockedUser::where('user_id',$this->id)
            ->orWhere('email',$this->email);

        if($this->ip_addresses){
            $block_exists = $block_exists->orWhereIn('ip_address', $this->ip_addresses ? [] : json_decode($this->ip_addresses,true) );
        }

        return $block_exists->first();
    }

    public function addIpAddress($ip_address){

        //get current ip addresses
        $current_ip_addresses = $this->ip_addresses;

        //convert them to collection if no addresses create empty collection
        $new_ip_addresses = !$current_ip_addresses ? collect() : collect(json_decode($current_ip_addresses,true));

        //add new address if doesnt exist
        if(!$new_ip_addresses->contains($ip_address)){
            $new_ip_addresses->add($ip_address);
            $this->ip_addresses = $new_ip_addresses;
            $this->save();
        }



        return  $this;
    }
}
