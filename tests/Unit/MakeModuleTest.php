<?php

namespace Elmogy\Larafast\Tests\Unit;

use Elmogy\Larafast\Tests\TestCase;
use Elmogy\Larafast\Logic\FileManipulator;

class MakeModuleTest extends TestCase
{
    /**
     * will keep this test here for now (as we need to test creating the unit and there is no module created yet)
     */
    public function test_the_unit_command_create_basic_files_init_case_in_specified_module_case_module_not_exist()
    {
        $command = $this->artisan("larafast:unit $this->unit --module=$this->module --init");
        $command->expectsOutput(__('larafast::unit.module_missing'));
    }

    public function test_the_module_command_create_module_directory()
    {
        $this->artisan("larafast:module $this->module");
        $this->assertTrue(FileManipulator::exists($this->module_dir));
    }

    public function test_when_module_directory_exists_users_can_choose_to_override_it()
    {
        $command = $this->artisan("larafast:module $this->module");

        $command->expectsConfirmation(
            __('larafast::module.exists'), 'yes'
        );

        $command->expectsOutput(__('larafast::module.success'));
    }

    public function test_when_module_directory_exists_users_can_choose_to_not_override_it()
    {
        $command = $this->artisan("larafast:module $this->module");

        $command->expectsConfirmation(
            __('larafast::module.exists'), 'no'
        );

        $command->expectsOutput(__('larafast::module.not_overwritten'));
    }
}
