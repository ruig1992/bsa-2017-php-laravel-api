<?php

/**
 * Tests Task3
 */
class Task3Test extends \Tests\TestCase
{

    const ENDPOINT = '/api/admin/cars';

    public function testIndex()
    {
        $response =  $this->json('GET', self::ENDPOINT);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJsonStructure([
            'id',
            'model',
            'year',
            'mileage',
            'registration_number',
            'price'
        ]);
    }

    public function testShow()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/1');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJsonStructure([
            'id',
            'model',
            'year',
            'mileage',
            'registration_number',
            'price'
        ]);
    }

    public function testStore()
    {
        $storeData = [
            'model' => 'VW Passat B8',
            'year' => '2014',
            'mileage' => 68456,
            'registration_number' => 'VW2014',
            'price' => 55
        ];

        $response =  $this->json('POST', self::ENDPOINT, $storeData);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJsonFragment($storeData);
    }

    public function testUpdate()
    {
        $storeData = [
            'mileage' => 69500,
            'price' => 58
        ];

        $response =  $this->json('PATCH', self::ENDPOINT . '/1', $storeData);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJsonFragment($storeData);
    }

    public function testDestroy()
    {
        $response =  $this->json('DELETE', self::ENDPOINT . '/1');
        $response->assertStatus(200);
    }
}