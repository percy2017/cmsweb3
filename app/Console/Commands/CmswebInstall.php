<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use TCG\Voyager\Providers\VoyagerDummyServiceProvider;
use TCG\Voyager\Traits\Seedable;
use TCG\Voyager\VoyagerServiceProvider;

class CmswebInstall extends Command
{
    use Seedable;

    protected $seedersPath = __DIR__.'/../../publishable/database/seeds/';

    protected $signature = 'cmsweb:install';

    protected $description = 'Instalador del CmsWeb v3.0';
    
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production', null],
            ['with-dummy', null, InputOption::VALUE_NONE, 'Install with dummy data', null],
        ];
    }

    protected function findComposer()
    {
        if (file_exists(getcwd().'/composer.phar')) {
            return '"'.PHP_BINARY.'" '.getcwd().'/composer.phar';
        }

        return 'composer';
    }

    public function fire(Filesystem $filesystem)
    {
        return $this->handle($filesystem);
    }

    public function handle(Filesystem $filesystem)
    {
        $this->info('Resenteando la Base de Datos');
        $this->call('migrate:reset');

        $this->info('Publicación de los activos del CmsWeb, la base de datos y los archivos de configuración');

        // Publish only relevant resources on install
        $tags = ['seeds'];

        $this->call('vendor:publish', ['--provider' => VoyagerServiceProvider::class, '--tag' => $tags]);

        $this->info('Migrar las tablas de la base de datos a su aplicación');
        // $this->call('migrate', ['--force' => $this->option('force')]);
        $this->call('migrate');

        // $this->info('Intentando configurar el modelo de usuario del CmsWeb como padre para App\User');
        // if (file_exists(app_path('User.php'))) {
        //     $str = file_get_contents(app_path('User.php'));

        //     if ($str !== false) {
        //         $str = str_replace('extends Authenticatable', "extends \TCG\Voyager\Models\User", $str);

        //         file_put_contents(app_path('User.php'), $str);
        //     }
        // } else {
        //     $this->warn('Unable to locate "app/User.php".  Did you move this file?');
        //     $this->warn('You will need to update this manually.  Change "extends Authenticatable" to "extends \TCG\Voyager\Models\User" in your User model');
        // }

        $this->info('Volcar los archivos con carga automática y volver a cargar todos los archivos nuevos');

        $composer = $this->findComposer();

        $process = new Process($composer.' dump-autoload');
        $process->setTimeout(null); // Setting timeout to null to prevent installation from stopping at a certain point in time
        $process->setWorkingDirectory(base_path())->run();

        // $this->info('Adding Voyager routes to routes/web.php');
        // $routes_contents = $filesystem->get(base_path('routes/web.php'));
        // if (false === strpos($routes_contents, 'Voyager::routes()')) {
        //     $filesystem->append(
        //         base_path('routes/web.php'),
        //         "\n\nRoute::group(['prefix' => 'admin'], function () {\n    Voyager::routes();\n});\n"
        //     );
        // }

        // \Route::group(['prefix' => 'admin'], function () {
        //     \Voyager::routes();
        // });

        $this->info('Sembrando datos en la base de datos');
        $this->seed('VoyagerDatabaseSeeder');

        // if ($this->option('with-dummy')) {
        //     $this->info('Publishing dummy content');
        //     $tags = ['dummy_seeds', 'dummy_content', 'dummy_config', 'dummy_migrations'];
        //     $this->call('vendor:publish', ['--provider' => VoyagerDummyServiceProvider::class, '--tag' => $tags]);

        //     $this->info('Migrating dummy tables');
        //     $this->call('migrate');

        //     $this->info('Seeding dummy data');
        //     $this->seed('VoyagerDummyDatabaseSeeder');
        // } else {
            $this->call('vendor:publish', ['--provider' => VoyagerServiceProvider::class, '--tag' => ['config', 'voyager_avatar']]);
        // }

        $this->info('Configurar el hooks');
        $this->call('hook:setup');

        $this->info('Agregar el enlace simbólico de almacenamiento a su carpeta pública');
        $this->call('storage:link');

        $this->info('CmsWeb v3.0 instalado con éxito! Disfrutalo');
 
    }
}
