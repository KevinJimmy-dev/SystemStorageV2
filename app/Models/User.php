<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property int $admin_id
 * @property int $coordinator_id
 * @property int $employee_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $cpf
 * @property string $phone
 * @property string $status
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const TYPE_ADMIN = 'Admin';
    const TYPE_COORDINATOR = 'Coordinator';
    const TYPE_EMPLOYEE = 'Employee';

    protected $fillable = ['admin_id', 'coordinator_id', 'employee_id', 'name', 'email', 'username', 'password', 'cpf', 'phone', 'status'];

    protected $hidden = ['password'];

    protected $with = ['categories', 'controls', 'requests'];

    public function admin(): BelongsTo{
        return $this->belongsTo(Admin::class);
    }

    public function coordinator(): BelongsTo{
        return $this->belongsTo(Coordinator::class);
    }

    public function employee(): BelongsTo{
        return $this->belongsTo(Employee::class);
    }

    public function requests(): BelongsTo{
        return $this->belongsTo(Request::class);
    }

    public function controls(): BelongsTo{
        return $this->belongsTo(Control::class);
    }

    public function categories(): HasMany{
        return $this->hasMany(Category::class);
    }
}
