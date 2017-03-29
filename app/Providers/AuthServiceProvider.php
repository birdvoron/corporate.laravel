<?php

namespace Corp\Providers;
use Corp\Article;
use Corp\Menu;
use Corp\Permission;
use Corp\Policies\ArticlePolicy;
use Corp\Policies\MenusPolicy;
use Corp\Policies\PermissionPolicy;
use Corp\Policies\UserPolicy;
use Corp\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Permission::class => PermissionPolicy::class,
        Menu::class => MenusPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('VIEW_ADMIN',function($user) {
            return $user->canDo('VIEW_ADMIN', FALSE);
        });
        $gate->define('VIEW_ADMIN_ARTICLES',function($user) {
            return $user->canDo('VIEW_ADMIN_ARTICLES', FALSE);
        });
        $gate->define('EDIT_USERS',function($user) {
            return $user->canDo('EDIT_USERS', FALSE);
        });
        $gate->define('VIEW_ADMIN_MENU',function($user) {
            return $user->canDo('VIEW_ADMIN_MENU', FALSE);
        });
    }
}
