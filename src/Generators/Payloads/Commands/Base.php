<?php

namespace Elmogy\Larafast\Generators\Payloads\Commands;

use Elmogy\Larafast\Generators\Payloads\GeneratorInterface;
use Illuminate\Console\Command;

class Base implements GeneratorInterface
{
    /**
     * related command
     *
     * @var Command
     */
    protected $command;

    /**
     * all the args passed
     *
     * @var array
     */
    protected $args;

    /**
     * the root dir
     *
     * @var string
     */
    protected $root_dir;

    /**
     * the plugins dir
     *
     * @var string
     */
    protected $plugins_dir;

    /**
     * init
     *
     * @param  Command $command
     * @param  array $args
     * @return void
     */
    public function __construct(Command $command, $args)
    {
        $this->command     = $command;
        $this->args        = $args;
        $this->root_dir    = config('larafast.root_dir');
        $this->plugins_dir = config('larafast.plugins_dir');
    }

    /**
     * run the logic
     *
     * @return void
     * @codeCoverageIgnore
     */
    public function run()
    {
        //
    }
}
