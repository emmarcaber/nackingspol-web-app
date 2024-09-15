<?php

namespace App\Policies;

use App\Helpers\ExtractClassNameHelper;
use App\Models\User;

/**
 * The BasePolicy class serves as an abstract base class for defining 
 * policies related to user permissions on various models. It handles 
 * common authorization checks like viewing, creating, updating, and deleting.
 * Derived classes should implement the `model()` method to specify the model 
 * they are authorizing actions for.
 */
abstract class BasePolicy
{
    /**
     * @var string Holds the name of the model being authorized.
     */
    private string $model;

    /**
     * Abstract method that derived classes must implement to specify the 
     * model name that the policy applies to.
     *
     * @return string The class name of the model.
     */
    abstract public function model(): string;

    /**
     * Create a new policy instance.
     * 
     * This constructor uses the ExtractClassNameHelper to extract the base name 
     * of the model class, allowing for more flexible string-based permission checks.
     */
    public function __construct()
    {
        $this->model = ExtractClassNameHelper::extract($this->model());
    }

    /**
     * Determine whether the user can view any instances of the model.
     *
     * @param User $user The user attempting to view models.
     * @return bool True if the user has permission, false otherwise.
     */
    public function viewAny(User $user): bool
    {
        return $user->can("view any $this->model");
    }

    /**
     * Determine whether the user can view a specific instance of the model.
     *
     * @param User $user The user attempting to view the model.
     * @return bool True if the user has permission, false otherwise.
     */
    public function view(User $user): bool
    {
        return $user->can("view $this->model");
    }

    /**
     * Determine whether the user can create a new instance of the model.
     *
     * @param User $user The user attempting to create the model.
     * @return bool True if the user has permission, false otherwise.
     */
    public function create(User $user): bool
    {
        return $user->can("create $this->model");
    }

    /**
     * Determine whether the user can update a specific instance of the model.
     *
     * @param User $user The user attempting to update the model.
     * @return bool True if the user has permission, false otherwise.
     */
    public function update(User $user): bool
    {
        return $user->can("update $this->model");
    }

    /**
     * Determine whether the user can delete a specific instance of the model.
     *
     * @param User $user The user attempting to delete the model.
     * @return bool True if the user has permission, false otherwise.
     */
    public function delete(User $user): bool
    {
        return $user->can("delete $this->model");
    }

    /**
     * Determine whether the user can restore a previously deleted instance of the model.
     *
     * @param User $user The user attempting to restore the model.
     * @return bool True if the user has permission, false otherwise.
     */
    public function restore(User $user): bool
    {
        return $user->can("restore $this->model");
    }

    /**
     * Determine whether the user can permanently delete a specific instance of the model.
     *
     * @param User $user The user attempting to force delete the model.
     * @return bool True if the user has permission, false otherwise.
     */
    public function forceDelete(User $user): bool
    {
        return $user->can("force delete $this->model");
    }
}
