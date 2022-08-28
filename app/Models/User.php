<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['admin_id', 'coordinator_id', 'employee_id', 'name', 'email', 'username', 'password', 'cpf', 'phone', 'status'];

    protected $hidden = ['password'];

    protected $with = ['categories', 'controls', 'requests'];

    public function requests(){
        return $this->hasMany(Request::class);
    }

    public function control(){
        return $this->belongsTo(Control::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public static function userLevel(){
        $user = auth()->user();

        if(is_null($user)){
            throw new Exception('Usuário não autenticado');
        }

        return $user->level;
    }
}
