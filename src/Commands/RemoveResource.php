<?php
/**
 * Author: hitman
 * Date: 28/9/2016
 * Time: 6:07 PM
 */


namespace Hitman\Resource\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class RemoveResource extends Command
{

    protected $signature = 'resource:remove';
    protected $description = '删除一个资源';

    public function handle()
    {
        $name = $this->ask("资源名称");
        $this->deleteModel($name);
        $this->deleteRoute($name);
        $this->deleteController($name);
        $this->deleteView($name);
        $this->deleteTable($name);
    }

    private function deleteTable($name)
    {
        Schema::dropIfExists(str_plural($name));
        $this->error("迁移文件和数据库需要自行删除");
    }

    private function deleteModel($name)
    {
        $model = studly_case($name);
        $path  = app_path('Models') . "/{$model}.php";
        $this->unlink($path);

        $this->info("删除模型...");
    }

    private function deleteRoute($name)
    {
        $resources = config('resource');
        $resources = collect($resources)->filter(function ($r) use ($name) {
            return $r != $name;
        })->toArray();
        $resources = array_unique($resources);
        $content   = $this->phpView(view('console.route', ['resources' => $resources]));

        file_put_contents(config_path('resource.php'), $content);
        $this->info("生成路由...");
    }

    private function deleteController($name)
    {
        $filename           = studly_case(str_plural($name)) . "Controller.php";
        $adminController    = app_path('Http/Controllers/Web/Admin/') . $filename;
        $adminApiController = app_path('Http/Controllers/Web/Admin/Api/') . $filename;
        $apiController      = app_path('Http/Controllers/Api/') . $filename;

        $this->unlink($adminController);
        $this->unlink($adminApiController);
        $this->unlink($apiController);
        $this->info("删除控制器...");
    }

    private function deleteView($name)
    {
        $dir = resource_path("views/admin/resource/{$name}");
        $this->unlink("{$dir}/index.blade.php");
        $this->unlink("{$dir}/show.blade.php");
        $this->unlink("{$dir}/create.blade.php");
        $this->unlink("{$dir}/edit.blade.php");
        if(is_dir($dir)){
            rmdir($dir);
        }

        $this->info('删除视图...');
    }

    private function phpView($view)
    {
        return "<?php \n\n" . $view;
    }

    private function unlink($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}