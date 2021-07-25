<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Lab404\Impersonate\Models\Impersonate;
use LancerHe\RBAC\Traits\RBACUser;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package App\Models\Admin
 */
class User extends \Illuminate\Foundation\Auth\User {

    use Notifiable;

    use Impersonate;

    use RBACUser {
        roles as protected traitRoles;
        permissions as protected traitPermissions;
        arrayPermissions as protected traitArrayPermissions;
        hasPermissions as protected traitHasPermissions;
        hasRoles as protected traitHasRoles;
    }

    private $arrayPermissions = null;

    /**
     * Cache arrayPermissions.
     * @return array
     */
    public function arrayPermissions(): ?array {
        if (!is_null($this->arrayPermissions)) {
            return $this->arrayPermissions;
        }
        $this->arrayPermissions = $this->traitArrayPermissions();
        return $this->arrayPermissions;
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany {
        return $this->traitRoles()->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany {
        return $this->traitPermissions()->withTimestamps();
    }

    public function hasPermissions($permissions, $requireAll = false): bool {
        // ID = 1 for Admin
        if ($this->id == 1) {
            return true;
        }
        return $this->traitHasPermissions($permissions, $requireAll);
    }

    public function hasRoles($roles, $requireAll = false): bool {
        // ID = 1 for Admin
        if ($this->id == 1) {
            return true;
        }
        return $this->traitHasRoles($roles, $requireAll);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(): bool {
        return $this->attributes["id"] == 1;
    }

    /**
     * @return bool
     */
    public function canImpersonate(): bool {
        return $this->isAdmin();
    }

    public function gravatar($size = '100') {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://sdn.geekzu.org/avatar/$hash?s=$size";
    }
}
