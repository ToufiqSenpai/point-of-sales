<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ValidatorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_message_validator_all_required(): void
    {
        $data = [
            'firstname' => '',
            'lastname' => ''
        ];

        $validator = Validator::make($data, [
            'firstname' => 'required',
            'lastname' => 'required'
        ]);

        var_dump($validator->errors()->all());

        $this->assertNotEquals(count($validator->errors()->all()), 0);
    }
}
