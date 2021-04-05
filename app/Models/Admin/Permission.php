<?php

namespace App\Models\Admin;

/**
 * Class Permission
 *
 * @package App\Models\Admin
 */
class Permission extends \LancerHe\RBAC\Model\Permission {

    protected $fillable = [
        'name', 'slug', 'prefix',
    ];
}
