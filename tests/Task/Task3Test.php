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

    public function testShow()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/2');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertExactJson([
            'id' => 2,
            'model' => 'Hyundai Elantra',
            'color' => 'Silver',
            'license_number' => 'HE3214',
            'year' => '2015',
            'price' => 30
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