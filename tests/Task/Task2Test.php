<?php

/**
 * Tests Task2
 */
class Task2Test extends \Tests\TestCase
{

    const ENDPOINT = '/api/cars';

    public function testStatus()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/1');
        $response->assertStatus(200);
    }

    public function testHeader()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/1');
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function testContent()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/1');
        $response->assertExactJson([
            'id' => 1,
            'model' => 'Mercedes C-Classe',
            'color' => 'White',
            'registration_number' => 'MB1234',
            'mileage' => 102568,
            'year' => '2012',
            'price' => 50,
        ]);
    }

    public function testNotExistingId()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/99999999');
        $response->assertStatus(404);
    }

    public function testUnecessaryRoutes()
    {
        $response =  $this->json('POST', self::ENDPOINT . '/1');
        $response->assertStatus(405);

        $response =  $this->json('DELETE', self::ENDPOINT . '/1');
        $response->assertStatus(405);

        $response =  $this->json('PATCH', self::ENDPOINT . '/1');
        $response->assertStatus(405);

        $response =  $this->json('PUT', self::ENDPOINT . '/1');
        $response->assertStatus(405);
    }
}