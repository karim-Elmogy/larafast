<?php

namespace Elmogy\Larafast\Tests\Unit\Processors;

use Elmogy\Larafast\Processors\RequestProcessor;

class RequestProcessorTest extends ProcessorTestCase
{
    public function test_output_str()
    {
        $processor    = new RequestProcessor($this->module_dir, $this->module_collection, $this->unit_collection);
        $output_str   = $processor->process();
        $expected_str = <<<STR
                                            'name' => 'string|required',
                                            'email' => 'string|unique:units|nullable',
                                            'type' => 'string|unique:units|nullable',
                                            'image_url' => 'string|unique:units|nullable',
                                            'phone' => 'string|nullable',
                                            'enum_str' => 'required',
                                            'is_done' => 'required',

                        STR;
        $expected_str = preg_replace("/\r/", "", $expected_str);
        $this->assertEquals($expected_str, $output_str);
    }
}
