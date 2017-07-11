<?php

/**
 * Tests Task3
 */
class Task3Test extends \Tests\TestCase
{

    public function testIndex()
    {
        $response = $this->get('/api/admin/cars');
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
        $response = $this->get('/api/admin/cars/1');
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

        $response = $this->post('/api/admin/cars', $storeData);
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

        $response = $this->patch('/api/admin/cars/1', $storeData);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJsonFragment($storeData);
    }

    public function testDestroy()
    {
        $response = $this->delete('/api/admin/cars/1');
        $response->assertStatus(200);
    }
}