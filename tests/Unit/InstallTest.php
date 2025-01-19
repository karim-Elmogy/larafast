<?php

namespace Elmogy\Larafast\Tests\Unit;

use Elmogy\Larafast\Tests\TestCase;
use Elmogy\Larafast\Logic\FileManipulator;

class InstallTest extends TestCase
{
    /**
     * will keep this test here for now (we need to test creating the module and the user didn't run install command)
     */
    public function test_create_module_before_running_install_command()
    {
        $command = $this->artisan("larafast:module $this->module");
        $command->expectsOutput(__('larafast::module.run_install'));
    }

    public function test_the_install_command_create_root_directory()
    {
        $this->artisan('larafast:install');
        $this->assertTrue(FileManipulator::exists($this->root_dir));
    }

    public function test_when_the_package_already_installed_users_can_choose_to_override_the_files()
    {
        $command = $this->artisan('larafast:install');

        $command->expectsConfirmation(
            __('larafast::install.already_installed'), 'yes'
        );

        $command->expectsOutput(__('larafast::install.success'));
    }

    public function test_when_the_package_already_installed_users_can_choose_to_not_override_the_files()
    {
        $command = $this->artisan('larafast:install');

        $command->expectsConfirmation(
            __('larafast::install.already_installed'), 'no'
        );

        $command->expectsOutput(__('larafast::install.root_dir_not_overwritten'));
    }
}
