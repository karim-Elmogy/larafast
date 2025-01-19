<?php

namespace Elmogy\Larafast\Commands;

use Illuminate\Console\Command;
use Elmogy\Larafast\Generators\Payloads\GeneratorFactory;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larafast:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the package';

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
     * @return int
     */
    public function handle()
    {
        $command = GeneratorFactory::create($this, 'Install');
        $command->run();
    }
}
