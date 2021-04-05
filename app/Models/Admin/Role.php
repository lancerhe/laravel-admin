<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Role
 *
 * @package App\Models\Admin
 */
class Role extends \LancerHe\RBAC\Model\Role {

    /**
     * @return BelongsToMany
     */
    public function permissions() {
        return parent::permissions()->withTimestamps();
    }

    protected $fillable = [
        'name', 'slug',
    ];
}
