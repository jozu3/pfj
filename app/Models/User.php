<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;
use App\Models\Personale;
use App\Models\Cord_auxiliare;

use Illuminate\Support\Facades\Storage;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'estado', 'password',
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

    public function adminlte_image(){
        if ($this->personale->contacto->image) {
            return Storage::url($this->personale->contacto->image->url);
        }
        // if($this->personale->contacto->fotodrive){
        //     return $this->personale->contacto->fotodrive;
        // }
        return 'https://picsum.photos/300/300';
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getProfilePhotoUrlAttribute(){
        return $this->adminlte_image();
    }

    public function updateProfilePhoto($input){
        if($input  != '' && $input != null){

            $url = Storage::put('contactos', $input);
            //$contacto->image()->delete();
            if($this->personale->contacto->image != null){
                Storage::delete($this->personale->contacto->image->url);
                $this->personale->contacto->image->update([
                    'url' => $url
                ]);
            } else {
                $this->personale->contacto->image()->create([
                    'url' => $url
                ]);
            }
            
        }
    }

    public function profile_photo_path(){
           return $this->adminlte_image();
    }

    public function adminlte_profile_url(){
        return 'user/profile';
    }


    public function personale(){
        return $this->hasOne(Personale::class);
    }


}