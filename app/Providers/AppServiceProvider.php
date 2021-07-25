<?php

namespace App\Providers;

use App\Models\Admin\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use JeroenNoten\LaravelAdminLte\Http\ViewComposers\AdminLteComposer;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @param Factory $view
     * @param Dispatcher $events
     * @return void
     */
    public function boot(Factory $view, Dispatcher $events) {
        $this->addMenuListener($events);
        $this->registerViewComposers($view);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * adminlte 变量注入模版
     * @param Factory $view
     */
    private function registerViewComposers(Factory $view) {
        $view->composer(['layouts.page', 'components.breadcrumb'], AdminLteComposer::class);
    }

    /**
     * @param Dispatcher $events
     */
    private function addMenuListener(Dispatcher $events): void {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            /** @var User $user */
            $user = Auth::user();

            $event->menu->add(['text' => '控制台', 'icon' => 'fa fa-fw fa-home', 'url' => route("home")]);
            if ($user->hasPermissions(["user-view", "role-view", "permission-view"])) {
                $event->menu->add('系统管理');
                $submenu = [];
                if ($user->hasPermissions("user-view")) {
                    $submenu[] = ['text' => '用户管理', 'icon' => 'fa fa-fw fa-users', 'url' => route("admin.users.index")];
                }
                if ($user->hasPermissions("role-view")) {
                    $submenu[] = ['text' => '角色管理', 'icon' => 'fa fa-fw fa-user', 'url' => route("admin.roles.index")];
                }
                if ($user->hasPermissions("permission-view")) {
                    $submenu[] = ['text' => '权限管理', 'icon' => 'fa fa-fw fa-user-secret', 'url' => route("admin.permissions.index")];
                }
                $event->menu->add(['text' => '用户 & 权限', 'icon' => 'fa fa-fw fa-street-view', 'class' => 'treeview', 'submenu_class' => 'treeview-menu', 'submenu' => $submenu]);
            }
        });
    }
}
