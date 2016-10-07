<?php
/**
 * Author: hitman
 * Date: 28/9/2016
 * Time: 6:07 PM
 */


namespace Hitman\Resource\Commands;

use Illuminate\Console\Command;

class MakeResource extends Command
{

    protected $signature = 'resource:make';
    protected $description = '创建一个资源';

    public function handle()
    {
        $name   = $this->ask("资源名称 英文");
        $nameZh = $this->ask("资源名称 中文");

        $this->createLocale($name, $nameZh);
        $this->createModel($name);
        $this->createRoute($name);
        $this->createController($name);
        $this->createTable($name);
        $this->createView($name);
        $this->composerDump();
    }

    private function createLocale($name, $nameZh)
    {
        $resources = require resource_path('lang/zh/resource.php');
        $resources[$name] = $nameZh;
        $content = $this->phpView(view('resource::locale', ['resources'=>$resources]));
        file_put_contents(resource_path('lang/zh/resource.php'), $content);

        $this->info("生成中文化文件...");
    }

    private function createTable($name)
    {
        $filename = date('Y_m_d_His') . "_create_table_" . str_plural($name) . ".php";
        $path     = base_path('database/migrations') . "/" . $filename;

        $className = studly_case("create_table_" . str_plural($name));
        $content   = $this->phpView(view('resource::migration.create', ['className' => $className, 'tableName' => str_plural($name)]));

        file_put_contents($path, $content);
        $this->info("数据表创建成功");
    }

    private function createModel($name)
    {
        $model = studly_case($name);
        $path  = app_path('Models') . "/{$model}.php";

        $content = $this->phpView(view('resource::model', ['model' => $model]));

        file_put_contents($path, $content);
        $this->info("Model创建成功");
    }

    private function createRoute($name)
    {
        $resources   = config('resource');
        $resources[] = $name;
        $resources   = array_unique($resources);
        $content     = $this->phpView(view('resource::route', ['resources' => $resources]));

        file_put_contents(config_path('resource.php'), $content);
        $this->info("路由创建成功");
    }

    private function createController($name)
    {
        $filename           = studly_case(str_plural($name)) . "Controller.php";
        $adminController    = app_path('Http/Controllers/Web/Admin/') . $filename;
        $adminApiController = app_path('Http/Controllers/Web/Admin/Api/') . $filename;
        $apiController      = app_path('Http/Controllers/Api/') . $filename;

        $adminContent = $this->phpView(view('resource::controller.admin', ['name'=>$name]));
        file_put_contents($adminController, $adminContent);

        $adminApiContent = $this->phpView(view('resource::controller.admin_api', ['name'=>$name]));
        file_put_contents($adminApiController, $adminApiContent);

        $apiContent = $this->phpView(view('resource::controller.api', ['name'=>$name]));
        file_put_contents($apiController, $apiContent);
        $this->info("创建控制器成功");
    }

    private function createView($name)
    {
        // 创建文件夹
        $dir = resource_path("views/admin/resource/{$name}");
        if(!is_dir($dir)){
            mkdir($dir);
        }
        $indexContent = view('resource::view.index', ['name'=>$name]);
        file_put_contents("{$dir}/index.blade.php", $indexContent);
        file_put_contents("{$dir}/show.blade.php", '');
        $this->generateCreateView($name);
        $this->generateUpdateView($name);

        $this->info('视图创建成功');
    }

    private function generateCreateView($name)
    {
        $content = view('resource::view.create', ['name' => $name]);
        $path    = resource_path('views/admin/resource/' . $name);
        $this->mkdir($path);
        file_put_contents($path . "/create.blade.php", $content);
    }

    private function generateUpdateView($name)
    {
        $content = view('resource::view.edit', ['name' => $name]);
        $path    = resource_path('views/admin/resource/' . $name);
        $this->mkdir($path);
        file_put_contents($path . "/edit.blade.php", $content);
    }

    private function phpView($view)
    {
        return "<?php \n\n" . $view;
    }

    private function composerDump()
    {
        $base = base_path();
        $command = "cd {$base} && composer dump";
        exec($command);
    }

    private function mkdir($path)
    {
        if(!is_dir($path)){
            mkdir($path);
        }
    }
}