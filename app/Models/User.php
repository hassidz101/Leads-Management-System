<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helpers\FakerURL;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    CONST ADMIN_ROLE = 'admin';
    CONST AGENT_ROLE = 'agent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'username',
        'surname',
        'phone',
        'is_active',
        'profile_img',
        'last_activity',
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

    protected $appends = ['faker_id', 'full_name', 'user_online_status'];

    public function getFakerIdAttribute()
    {
        return FakerURL::id_e($this->id);
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function getFullNameAttribute(){
        return $this->name.' '.$this->surname;
    }

    public function getUserOnlineStatusAttribute(){
        $now = date('Y-m-d H:i:s');
        if (strtotime($now) >= strtotime($this->last_activity)+300) {
            return false;
        }
        return true;
    }

}
