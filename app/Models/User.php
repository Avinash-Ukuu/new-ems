<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value),
        );
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    // show roles

    public function showRoles()
    {
        if($this->roles->isEmpty())
        {
            return "N/A";
        }
        $roles  =   $this->roles->pluck("name","name")->toArray();
        return implode(",",$roles);

    }

    // Policies check functions
    public function hasRole($role)
    {
        if ($this->super_admin) {
            return true;
        }
        else if(($this->roles->where("name","admin"))->isNotEmpty() ? $this->roles->where("name","admin")->first()->name == 'admin' : false)
        {
            return true;
        }
        $roles = $this->roles->pluck('name')->toArray();
        $roles = array_map('strtolower', $roles);
        if (in_array(strtolower($role), $roles)) {
            return true;
        }
        return false;
    }

    public function hasPermission($access, $module)
    {
        if ($this->hasRole('admin') || $this->super_admin) {
            return true;
        }
        if ($this->permissionCache == null) {
            $this->permissionCache = $this->permissions();
        }
        if (Module::$moduleCache == null) {
            Module::$moduleCache = Module::all();
        }
        $module = Module::$moduleCache->where('name', $module)->first();
        if ($this->permissionCache->isNotEmpty() && !empty($module)) {
            $permissions = $this->permissionCache->where('module_id', $module->id);
            if ($permissions->isNotEmpty()) {
                $permissions = $permissions->where('name', $access);
                if ($permissions->isNotEmpty()) {
                    return true;
                }
            }
        }

        return false;
    }

    private function permissions()
    {
        return $this->roles->load('permissions')->pluck('permissions')->collapse()->map(function ($item) {
            $item->access = strtolower($item->access);
            return $item;
        });
    }

}
