<?php

namespace App\Providers;

use A17\Twill\Models\Enums\UserRole;
use A17\Twill\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        parent::boot();

        Gate::define('administrate', function ($user) {
            return $this->authorize($user, function ($user) {
                return $user->role_value == UserRole::ADMIN;
            });
        });

        Gate::define('list', function ($user) {
            return $this->authorize($user, function ($user) {
                return $this->userHasRole($user, [UserRole::EDITOR, UserRole::PUBLISHER, UserRole::ADMIN]);
            });
        });

        Gate::define('edit', function ($user) {
            return $this->authorize($user, function ($user) {
                return $this->userHasRole($user, [UserRole::EDITOR, UserRole::PUBLISHER, UserRole::ADMIN]);
            });
        });

        Gate::define('reorder', function ($user) {
            return $this->authorize($user, function ($user) {
                return $this->userHasRole($user, [UserRole::EDITOR, UserRole::PUBLISHER, UserRole::ADMIN]);
            });
        });

        // Note that this gate does NOT affect the UserRole's ability to publish CRUD modules
        // (articles, issues, sections etc.), because toggling from draft to live in the editing page
        // is routed through ModuleController::update rather than publish. It does remove the bulk publish
        // options from drop downs in admin interface, as that goes through ModuleController::publish and is
        // correctly gated via Laravel's middleware.
        Gate::define('publish', function ($user) {
            return $this->authorize($user, function ($user) {
                return $this->userHasRole($user, [UserRole::PUBLISHER, UserRole::ADMIN]);
            });
        });

        Gate::define('feature', function ($user) {
            return $this->authorize($user, function ($user) {
                return $this->userHasRole($user, [UserRole::PUBLISHER, UserRole::ADMIN]);
            });
        });

        Gate::define('delete', function ($user) {
            return $this->authorize($user, function ($user) {
                return $this->userHasRole($user, [UserRole::EDITOR, UserRole::PUBLISHER, UserRole::ADMIN]);
            });
        });

        Gate::define('duplicate', function ($user) {
            return $this->authorize($user, function ($user) {
                return $this->userHasRole($user, [UserRole::EDITOR, UserRole::PUBLISHER, UserRole::ADMIN]);
            });
        });

        Gate::define('upload', function ($user) {
            return $this->authorize($user, function ($user) {
                return $this->userHasRole($user, [UserRole::EDITOR, UserRole::PUBLISHER, UserRole::ADMIN]);
            });
        });

    }
}
