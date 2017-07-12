<?php

namespace App;

use Illuminate\Contracts\Support\Arrayable;

class Car extends AbstractEntity implements Arrayable
{
    protected $id;
    protected $model;
    protected $year;
    protected $mileage;
    protected $registration_number;
    protected $color;
    protected $price;

    protected $fillable = [
        'id',
        'model',
        'year',
        'mileage',
        'registration_number',
        'color',
        'price'
    ];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        return $this->fromArray($data);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Car
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     * @return Car
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * @param mixed $mileage
     * @return Car
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegistrationNumber()
    {
        return $this->registration_number;
    }

    /**
     * @param mixed $registration_number
     * @return Car
     */
    public function setRegistrationNumber($registration_number)
    {
        $this->registration_number = $registration_number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     * @return Car
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return Car
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param array|null $fields
     * @return array
     */
    public function toArray(array $fields = null): array
    {
        if (empty($fields)) {
            $fields = $this->fillable;
        }

        $fields = array_flip($fields);
        $data = [];

        foreach ($this->fillable as $field) {
            $method = 'get' . camel_case($field);

            if (array_has($fields, $field)) {
                $data[$field] = $this->$method();
                continue;
            }
            if (array_has($fields, snake_case($field))) {
                $data[snake_case($field)] = $this->$method();
            }
        }

        return $data;
    }
}
