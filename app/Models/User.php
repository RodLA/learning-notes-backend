<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetPasswordNotification;
use App\Traits\HasPermissions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //?Validate Roles of User.
    public function hasRoles(...$roles){
        // $user->hasRole('edit-user','edit-issue');
        return $this->roles()->whereIn('slug', $roles)->count();
    }
    //?get roles of User
    public function roles(){
        //( modelo relacionado, tabla intermedia )
        //devuelve los roles de ese usuario
        return $this->belongsToMany( Role::class, 'users_roles' );
    }

    //?get Permission of User
    public function permissions(){
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function sendPasswordResetNotification($token)
    {
        $url = env('FRONT_APP').'/reset-password?token='.$token;

        $this->notify(new ResetPasswordNotification($url));
    }
}
