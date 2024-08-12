<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InicializarDBAPPCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inicializar:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'inicializar db de la app';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call("db:seed --class=InicializarDBSeeder");


        $this->info("Base de dato inicializada");

        return Command::SUCCESS;
    }
}
