<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'level',
        'stats'
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

    public function requests(){
        return $this->hasMany('App\Models\Request');
    }

    public function control(){
        return $this->belongsTo('App\Models\Control');
    }

    public static function userLevel(){

        $user = auth()->user();

        if($user){
            $userLevel = User::where('level', $user->level)->first()->toArray();
        }

        return $userLevel;
    }

    public static function createEmployee($request, $exists){
        if($exists == null || $exists->username != $request->username){
            $info = $request->only(['name', 'username', 'password']);
            $info['password'] = bcrypt($info['password']);
            
            if($request->level){
                $info['level'] = $request->level;
            } else{
                $info['level'] = 1;
            }

            $info['stats'] = 1;

            User::create($info);

            return true;
        }
    }
}
