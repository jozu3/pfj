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
use Intervention\Image\Facades\Image as ImageIntervention;

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
        return config('app.url').'/img/user-pfj.png' ;
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

            $extension = $input->getClientOriginalExtension();
            $name_img = $this->personale->contacto->id."_". str_replace(" ", "_", $this->personale->contacto->nombres)."_". str_replace(" ", "_", $this->personale->contacto->apellidos).".".$extension;
            // $url = "contactos/".$name_img;

            $url = Storage::put("contactos", $input);
            //image 200x200
            if($this->personale->contacto->image200x200 != null){
                Storage::delete($this->personale->contacto->image200x200->url);
            }

            $image_200x200 = ImageIntervention::make($input)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($extension);
            $url_200x200 = 'contactos/200x200/'.$name_img ;
            Storage::put($url_200x200, $image_200x200->__toString());
            // dd($url_200x200);
            
            if($this->personale->contacto->image != null){
                Storage::delete($this->personale->contacto->image->url);
                $this->personale->contacto->image->update([
                    'url' => $url,
                    'tipo' => 'original'
                ]);
            } else {
                $this->personale->contacto->image()->create([
                    'url' => $url,
                    'tipo' => 'original'
                ]);
            }
            
            if($this->personale->contacto->image200x200 != null){
                $this->personale->contacto->image200x200()->update([
                    'url' => $url_200x200,
                    'tipo' => '200x200'                
                ]);
            } else {
                $this->personale->contacto->image200x200()->create([
                    'url' => $url_200x200,
                    'tipo' => '200x200'
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
    public function fullname(){
        $contacto = $this->personale->contacto;
        return $contacto->nombres.' '.$contacto->apellidos;
    }


}