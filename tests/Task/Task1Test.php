<?php

/**
 * Tests Task1
 */
class Task1Test extends \Tests\TestCase
{

    public function testStatus()
    {
        $response = $this->get('/api/cars');
        $response->assertStatus(200);
    }

    public function testHeader()
    {
        $response = $this->get('/api/cars');
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function testStructure()
    {
        $response = $this->get('/api/cars');
        $response->assertJsonStructure([
            [
                'id',
                'model',
                'year',
                'price'
            ]
        ]);
    }

    public function testUnecessaryRoutes()
    {
        $response = $this->post('/api/cars');
        $response->assertStatus(405);

        $response = $this->delete('/api/cars');
        $response->assertStatus(405);

        $response = $this->patch('/api/cars');
        $response->assertStatus(405);

        $response = $this->put('/api/cars');
        $response->assertStatus(405);
    }
}