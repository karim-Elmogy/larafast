<?php

namespace Elmogy\Larafast\Tests\Unit;

use Elmogy\Larafast\Tests\TestCase;

class MakeUnitTest extends TestCase
{
    public function test_not_including_module_option()
    {
        $command = $this->artisan("larafast:unit $this->unit");
        $command->expectsOutput(__('larafast::unit.module_required'));
    }

    public function test_the_unit_command_without_init_option_in_case_run_init_option_at_first_in_specified_module()
    {
        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");
        $command->expectsOutput(__('larafast::unit.init_not_executed'));
    }

    public function test_the_unit_command_init_case_in_specified_module()
    {
        $command = $this->artisan("larafast:unit $this->unit --module=$this->module --init");
        $command->expectsOutput(__('larafast::unit.success_init_executed'));
    }

    public function test_the_unit_command_repeat_init_case_in_specified_module()
    {
        $command = $this->artisan("larafast:unit $this->unit --module=$this->module --init");
        $command->expectsOutput(__('larafast::unit.init_executed'));
    }

    public function test_attributes_property_is_required()
    {
        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");
        $command->expectsOutput(__('larafast::unit.attributes_prop_required'));
    }

    public function test_type_property_is_required()
    {
        $data                       = $this->getDataFile();
        $data['attributes']['name'] = ['type'];
        $this->overrideDataFile($data);

        $params  = ['column_name' => 'name', 'unit_studly' => $this->unit];
        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");
        $command->expectsOutput(__('larafast::unit.type_prop_required', $params));
    }

    public function test_type_property_is_not_valid()
    {
        $data                       = $this->getDataFile();
        $data['attributes']['name'] = ['type' => 'stringgg'];
        $this->overrideDataFile($data);

        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");
        $command->expectsOutput(__('larafast::unit.type_prop_not_valid', ['type' => 'stringgg']));
    }

    public function test_the_value_in_type_property_should_have_a_value()
    {
        $data                       = $this->getDataFile();
        $data['attributes']['name'] = ['type' => 'enum'];
        $this->overrideDataFile($data);

        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");
        $command->expectsOutput(__('larafast::unit.type_prop_has_value', ['type' => 'enum']));
    }

    public function test_the_value_in_type_property_should_not_have_a_value()
    {
        $data                       = $this->getDataFile();
        $data['attributes']['name'] = ['type' => 'string:hello'];
        $this->overrideDataFile($data);

        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");
        $command->expectsOutput(__('larafast::unit.type_prop_has_no_value', ['type' => 'string']));
    }

    public function test_definition_property_is_not_valid()
    {
        $data                       = $this->getDataFile();
        $data['attributes']['name'] = ['type' => 'string', 'definition' => 'defaulttt'];
        $this->overrideDataFile($data);

        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");
        $command->expectsOutput(__('larafast::unit.definition_prop_not_valid', ['definition' => 'defaulttt']));
    }

    public function test_the_value_in_definition_property_should_have_a_value()
    {
        $data                       = $this->getDataFile();
        $data['attributes']['name'] = ['type' => 'string', 'definition' => 'default'];
        $this->overrideDataFile($data);

        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");
        $command->expectsOutput(__('larafast::unit.definition_prop_has_value', ['definition' => 'default']));
    }

    public function test_the_value_in_definition_property_should_not_have_a_value()
    {
        $data                       = $this->getDataFile();
        $data['attributes']['name'] = ['type' => 'string', 'definition' => 'nullable:test'];
        $this->overrideDataFile($data);

        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");
        $command->expectsOutput(__('larafast::unit.definition_prop_has_no_value', ['definition' => 'nullable']));
    }

    public function test_done_from_the_unit_setup()
    {
        $data                       = $this->getDataFile();
        $data['attributes']['name'] = ['type' => 'string', 'definition' => 'default:test'];
        $this->overrideDataFile($data);

        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");
        $command->expectsOutput(__('larafast::unit.success_init_not_executed'));
    }

    public function test_override_already_existing_unit()
    {
        $data               = $this->getDataFile();
        $data['attributes'] = [
            'name'   => ['type' => 'string', 'definition' => 'default:test'],
            'email'  => ['type' => 'string', 'definition' => 'unique|nullable'],
            'status' => ['type' => 'enum:active,disabled,pending']
        ];

        $this->overrideDataFile($data);

        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");

        $command->expectsConfirmation(
            __('larafast::unit.exists'), 'yes'
        );

        $command->expectsOutput(__('larafast::unit.success_init_not_executed'));
    }

    public function test_not_override_already_existing_unit()
    {
        $data                       = $this->getDataFile();
        $data['attributes']['name'] = ['type' => 'string', 'definition' => 'default:test'];
        $this->overrideDataFile($data);

        $command = $this->artisan("larafast:unit $this->unit --module=$this->module");

        $command->expectsConfirmation(
            __('larafast::unit.exists'), 'no'
        );

        $command->expectsOutput(__('larafast::unit.not_overwritten'));
    }
}
