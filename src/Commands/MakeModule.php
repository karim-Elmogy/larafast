<?php

namespace Elmogy\Larafast\Commands;

use Illuminate\Console\Command;
use Elmogy\Larafast\Generators\Payloads\GeneratorFactory;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larafast:module {name} {--P|plugins}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $command = GeneratorFactory::create($this, 'MakeModule', $this->argument('name'), $this->option('plugins'));
        $command->run();
    }
}
