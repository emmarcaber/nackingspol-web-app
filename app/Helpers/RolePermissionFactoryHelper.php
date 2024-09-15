<?php

namespace App\Helpers;

use App\Types\RoleType;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RolePermissionFactoryHelper
 *
 * This class is responsible for managing role-based permissions. It handles the creation, assignment,
 * and removal of permissions to roles based on predefined configurations from the RoleType class.
 */
class RolePermissionFactoryHelper
{
    /**
     * The class name for which the permissions are being managed.
     *
     * @var string
     */
    private string $class;

    /**
     * Create a new instance of the RolePermissionFactoryHelper.
     *
     * @param string $class The class name for which the permissions are being managed.
     */
    public function __construct(string $class)
    {
        $this->class = ExtractClassNameHelper::extract($class);
        $rolePermissions = RoleType::getDefaultPermissions($this->class);

        foreach ($rolePermissions as $role => $permissions) {
            $this->seedPermissions($permissions);
            $this->givePermissionToRole($role, $permissions);
        }
    }

    /**
     * Create a new instance of RolePermissionFactoryHelper using the static factory method.
     *
     * @param string $class The class name for which the permissions are being managed.
     * @return self The instance of RolePermissionFactoryHelper.
     */
    public static function make(string $class): self
    {
        return new self($class);
    }

    /**
     * Add new permissions to roles.
     *
     * @param array $rolePermissions An associative array where keys are roles and values are arrays of permissions.
     * @return self The instance of RolePermissionFactoryHelper.
     */
    public function addPermissions(array $rolePermissions): self
    {
        foreach ($rolePermissions as $role => $permissions) {
            $convertedPermissions = $this->convertRawPermissions($permissions);
            $this->seedPermissions($convertedPermissions);
            $this->givePermissionToRole($role, $convertedPermissions);
        }

        return $this;
    }

    /**
     * Convert raw permissions by appending the class name.
     *
     * @param array $permissions An array of raw permissions.
     * @return array An array of formatted permissions with the class name appended.
     */
    public function convertRawPermissions(array $permissions): array
    {
        return array_map(function ($permission) {
            return "$permission $this->class";
        }, $permissions);
    }

    /**
     * Seed permissions into the database, creating them if they do not already exist.
     *
     * @param array $permissions An array of permissions to seed.
     * @return void
     */
    public function seedPermissions(array $permissions): void
    {
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
                'group' => $this->class,
            ]);
        }
    }

    /**
     * Assign permissions to a role.
     *
     * @param string $role The name of the role.
     * @param array $permissions An array of permissions to assign to the role.
     * @return void
     */
    public function givePermissionToRole(string $role, array $permissions): void
    {
        $roleModel = Role::findByName($role);

        if ($roleModel) {
            $roleModel->givePermissionTo($permissions);
        }
    }

    /**
     * Remove permissions from a role.
     *
     * @param array $rolePermissions An associative array where keys are roles and values are arrays of permissions.
     * @return self The instance of RolePermissionFactoryHelper.
     */
    public function removePermissionFromRole(array $rolePermissions): self
    {
        foreach ($rolePermissions as $role => $permissions) {
            $convertedPermissions = $this->convertRawPermissions($permissions);
            Role::findByName($this->class)
                ->removePermissionsFromRole($role, $convertedPermissions);
        }

        return $this;
    }
}
