<?php

namespace Elmogy\Larafast\Commands;

use Illuminate\Console\Command;
use Elmogy\Larafast\Generators\Payloads\GeneratorFactory;

class MakeUnit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larafast:unit {name} {--module=} {--I|init} {--P|plugins}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new unit';

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
        if (!$this->option('module')) {
            $this->error(__('larafast::unit.module_required'));
            return;
        }

        $command = GeneratorFactory::create(
            $this,
            'MakeUnit',
            $this->argument('name'),
            $this->option('module'),
            $this->option('init'),
            $this->option('plugins')
        );

        $command->run();
    }
}
