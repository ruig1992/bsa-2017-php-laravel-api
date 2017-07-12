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

    public function testContent()
    {
        $response =  $this->json('GET', self::ENDPOINT);
        $this->assertCount(4, $response->json());

        $response->assertExactJson([
            [
                'id' => 1,
                'model' => 'Mercedes C-Classe',
                'color' => 'White',
                'year' => '2012',
                'price' => 50
            ], [
                'id' => 2,
                'model' => 'Hyundai Elantra',
                'color' => 'Silver',
                'year' => '2015',
                'price' => 30
            ], [
                'id' => 3,
                'model' => 'Skoda Octavia',
                'color' => 'Blue',
                'year' => '2013',
                'price' => 35
            ], [
                'id' => 4,
                'model' => 'BMW Series 7',
                'color' => 'Black',
                'year' => '2010',
                'price' => 60
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