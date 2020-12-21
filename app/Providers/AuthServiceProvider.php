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
        // (articles, issues, sections etc.), because Twill does not consult Gate::allows when
        // updates are happening. We implements this check in Http/Controllers/Admin/GatedModuleController
        //
        // However, it does remove the bulk publish options from drop downs in admin interface.
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
