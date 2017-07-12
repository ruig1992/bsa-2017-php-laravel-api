<?php

namespace App\Helpers;

use App\Car;

/**
 * Helps to get the car data by certain requirements (data fields etc.)
 */
trait CarDataHelper
{
    /**
     * Get the car data by certain fields
     * @param  Car    $car
     * @param  array  $fields
     * @return array
     */
    public function getDataByFields(Car $car, array $fields): array
    {
        $fields = array_flip($fields);

        foreach ($fields as $field => &$value) {
            $method = explode('_', $field);
            array_walk($method, function(string &$part) {
                $part = ucfirst($part);
            });

            $method = 'get' . implode('', $method);
            if (!method_exists($car, $method)) {
                unset($fields[$field]);
                continue;
            }
            $value = $car->$method();
        }

        return $fields;
    }
}
