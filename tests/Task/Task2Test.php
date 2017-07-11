<?php

/**
 * Tests Task2
 */
class Task2Test extends \Tests\TestCase
{

    public function testStatus()
    {
        $response = $this->get('/api/cars/1');
        $response->assertStatus(200);
    }

    public function testHeader()
    {
        $response = $this->get('/api/cars/1');
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function testStructure()
    {
        $response = $this->get('/api/cars/1');
        $response->assertJsonStructure([
            'id',
            'model',
            'year',
            'mileage',
            'registration_number',
            'price'
        ]);
    }

    public function testNotExistingId()
    {
        $response = $this->get('/api/cars/99999999');
        $response->assertStatus(404);
    }

    public function testUnecessaryRoutes()
    {
        $response = $this->post('/api/cars/1');
        $response->assertStatus(405);

        $response = $this->delete('/api/cars/1');
        $response->assertStatus(405);

        $response = $this->patch('/api/cars/1');
        $response->assertStatus(405);

        $response = $this->put('/api/cars/1');
        $response->assertStatus(405);
    }
}