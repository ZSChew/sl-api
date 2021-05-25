<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_product(){
        $data = [
            'mykey' => "value1"
        ];

        $result_1 = $this->json('POST', route('products.store'), $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->getContent();
    }

    public function test_get_product(){
        $data = [
            'mykey' => "value1"
        ];

        $result_1 = $this->json('POST', route('products.store'), $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->getContent();

        $result_1_by_key = $this->get("/api/products/mykey")
            ->assertStatus(201)
            ->getContent();
        $this->assertSame($data['mykey'], str_replace('"', '', $result_1_by_key));
    }

    public function test_post_and_get_all()
    {
        $data = [
            'mykey' => "value1"
        ];

        $data2 = [
            'mykey' => "value2"
        ];

        $data3 = [
            'mykey3' => "value3"
        ];

        $final_result = ["mykey"=>"value2","mykey3"=>"value3"];

        $result_1 = $this->json('POST', route('products.store'), $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->getContent();

        $result_1_by_key = $this->get("/api/products/mykey")
            ->assertStatus(201)
            ->getContent();
        $this->assertSame($data['mykey'], str_replace('"', '', $result_1_by_key));

        sleep(2);

        $result_2 = $this->json('POST', route('products.store'), $data2, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->getContent();

        $result_3 = $this->json('POST', route('products.store'), $data3, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->getContent();

        $result_get_all_records = $this->json("GET","/api/products/get_all_records")
            ->assertStatus(201)
            ->getContent();
        $this->assertSame(json_encode($final_result), $result_get_all_records);
    }
}
