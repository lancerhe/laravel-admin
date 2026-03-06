# Repository Guidelines

## 项目结构与模块组织
本仓库是一个基于 Laravel 5.6、运行在 PHP 7.1 上的后台管理系统。核心业务代码位于 `app/`，其中后台控制器在 `app/Http/Controllers/Admin`，认证相关流程在 `app/Http/Controllers/Auth`，RBAC 相关模型在 `app/Models/Admin`。路由按用途拆分在 `routes/web.php`、`routes/api.php` 和 `routes/console.php`。Blade 模板和多语言文件分别位于 `resources/views` 与 `resources/lang`。数据库迁移、填充和工厂位于 `database/`。前端静态资源直接提交到 `public/`，包括 `public/css`、`public/js` 以及第三方 vendor 资源。

## 构建、测试与开发命令
本项目以 Composer 和 Artisan 为主：

- `composer install`：安装 PHP 依赖。
- `cp .env.example .env && php artisan key:generate`：初始化本地环境配置。
- `php artisan serve`：启动本地开发服务。
- `php artisan migrate`：执行数据库迁移。
- `vendor/bin/phpunit`：运行 `phpunit.xml` 中定义的全部测试。
- `vendor/bin/phpunit --filter ExampleTest`：只运行指定测试类，便于快速迭代。

## 代码风格与命名约定
遵循 `.editorconfig`：使用 UTF-8、LF 换行、4 空格缩进，Markdown 之外去除行尾空白。PHP 类使用 `App\\...` 的 PSR-4 命名空间。控制器按职责使用单数命名，如 `ProfileController`；模型使用 PascalCase，如 `Role`、`Permission`。Blade 视图使用小写目录路径，例如 `resources/views/admin/users/index.blade.php`。路由、配置和迁移文件优先遵循 Laravel 默认命名方式。

## 测试规范
当前测试框架为 PHPUnit。请求流程和集成测试放在 `tests/Feature`，纯逻辑单元测试放在 `tests/Unit`。测试文件统一使用 `*Test.php` 后缀，名称应直接表达目标行为，例如 `UserImpersonationTest.php`。涉及控制器、RBAC 权限、辅助函数的改动，应在提交 PR 前补充或更新对应测试。

## 提交与 Pull Request 规范
最近的提交信息以简短祈使句为主，中英文均可，例如 `Add check all.`、`Updated passwords.`。提交标题应简洁、聚焦行为变化。Pull Request 至少应包含变更摘要、受影响的路由或页面、所需的迁移或配置调整；如果涉及 Blade 页面或 AdminLTE 界面改动，附上截图。

## 安全与配置提示
不要提交密钥、账号或本地 `.env` 覆盖项。修改 `config/`、认证流程、用户模拟登录或 RBAC 权限逻辑时，需要重点核对后台访问安全。如果功能依赖缓存、队列或 Redis，请在 PR 中补充必要的环境变量说明。
