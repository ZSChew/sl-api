<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_and_get()
    {
        $data = [
            'key' => "titanlatest",
            'value' => "Titan Model 2020 old"
        ];

        $data2 = [
            'key' => "titanlatest",
            'value' => "Titan Model 2021 latest"
        ];

        $result_1 = $this->post(route('products.store'), $data)
                         ->assertStatus(201)
                         ->getContent();

       sleep(3);

        $result_2 = $this->post(route('products.store'), $data2)
                         ->assertStatus(201)
                         ->getContent();

        $result_by_key = $this->get(route('products.show', $data['key']))
                       ->assertStatus(201)
                       ->getContent();

        $this->assertSame($data2['value'],str_replace('"','',$result_by_key));
    }
}
