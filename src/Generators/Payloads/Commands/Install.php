<?php

namespace Elmogy\Larafast\Generators\Payloads\Commands;

use Elmogy\Larafast\Logic\FileManipulator;

class Install extends Base
{
    /**
     * run the logic
     *
     * @return void
     */
    public function run()
    {
        $allow_publish = true;
        if (FileManipulator::exists($this->root_dir)) {
            if ($this->command->confirm(__('larafast::install.already_installed'), true)) {
                $allow_publish = true;
            } else {
                $allow_publish = false;
                $this->command->warn(__('larafast::install.root_dir_not_overwritten'));
            }
        }

        if ($allow_publish) {
            $this->publishRootDirectory();
            $this->publishPluginsDirectory();
            $this->command->info(__('larafast::install.success'));
        }
    }

    /**
     * publish root directory
     *
     * @return void
     */
    protected function publishRootDirectory() {
        FileManipulator::generate(
            __DIR__ . '/../../../Core/Base',
            $this->root_dir . '/Base',
            config('larafast.base'),
            [
                'file'    => ['stub'],
                'content' => ['#SELECTED_DIRECTORY#', '#IS_PLUGINS#', '#MODULE_AND_IS_PLUGINS#']
            ],
            [
                'file'    => ['php'],
                'content' => ['Core', '', '']
            ]
        );
    }

    /**
     * publish plugins directory
     *
     * @return void
     */
    protected function publishPluginsDirectory() {
        FileManipulator::generate(
            __DIR__ . '/../../../Core/Base',
            $this->plugins_dir . '/Base',
            config('larafast.plugins_base'),
            [
                'file'    => ['stub'],
                'content' => ['#SELECTED_DIRECTORY#', '#IS_PLUGINS#', '#MODULE_AND_IS_PLUGINS#']
            ],
            [
                'file'    => ['php'],
                'content' => ['Plugins', 'true', ", 'base', true"]
            ]
        );
    }
}

