<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunModules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cmsweb:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instalador de los modulos del cmsweb';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
