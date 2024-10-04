<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const ROLES_WITH_DATA = [Role::Student, Role::Teacher];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'role',
        'two_factor_secret',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => Role::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(get: fn ($_, array $attributes) =>
            \implode(" ", \array_filter(\Arr::only($attributes, ['first_name', 'middle_name', 'last_name'])),
        ));
    }

    public function data(): HasOne
    {
        if (! in_array($role = $this->role, User::ROLES_WITH_DATA))
            throw new \Exception(sprintf(
                "Role [%s] does not have special data that can be retrieved",
                $role->name,
            ));

        return $this->hasOne($role->className(), 'user_id');
    }
}
