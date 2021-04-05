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

            $event->menu->add(['text' => 'Home', 'icon' => 'fa fa-fw fa-home', 'url' => route("home")]);
            if ($user->hasPermissions(["user-view", "role-view", "permission-view"])) {
                $event->menu->add('ADMIN SYSTEM');
                $submenu = [];
                if ($user->hasPermissions("user-view")) {
                    $submenu[] = ['text' => 'Users', 'icon' => 'fa fa-fw fa-users', 'url' => route("admin.users.index")];
                }
                if ($user->hasPermissions("role-view")) {
                    $submenu[] = ['text' => 'Roles', 'icon' => 'fa fa-fw fa-user', 'url' => route("admin.roles.index")];
                }
                if ($user->hasPermissions("permission-view")) {
                    $submenu[] = ['text' => 'Permissions', 'icon' => 'fa fa-fw fa-user-secret', 'url' => route("admin.permissions.index")];
                }
                $event->menu->add(['text' => 'Users & Permissions', 'icon' => 'fa fa-fw fa-street-view', 'class' => 'treeview', 'submenu_class' => 'treeview-menu', 'submenu' => $submenu]);
            }
        });
    }
}
