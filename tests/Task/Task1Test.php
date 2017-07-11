<?php

/**
 * Tests Task1
 */
class Task1Test extends \Tests\TestCase
{

    const ENDPOINT = '/api/cars';

    public function testStatus()
    {
        $response =  $this->json('GET', self::ENDPOINT);
        $response->assertStatus(200);
    }

    public function testHeader()
    {
        $response =  $this->json('GET', self::ENDPOINT);
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function testStructure()
    {
        $response =  $this->json('GET', self::ENDPOINT);
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
        $response =  $this->json('POST', self::ENDPOINT);
        $response->assertStatus(405);

        $response =  $this->json('DELETE', self::ENDPOINT);
        $response->assertStatus(405);

        $response =  $this->json('PATCH', self::ENDPOINT);
        $response->assertStatus(405);

        $response =  $this->json('PUT', self::ENDPOINT);
        $response->assertStatus(405);
    }
}