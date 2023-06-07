<?php

namespace App\Domains\Drivers\Factory;
use App\Domains\Drivers\Models\Driver;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker = Faker::create('ru_RU');
        $name = $this->faker->text(20);
        $createdDate = $this->faker->dateTimeBetween($staretDate = '-5 years', $endDate = 'now', $timezone = null);
        return [
            "full_name" => $name,
            "car_name" => $this->faker->text(20),
            "car_type" => $this->faker->randomDigit(),
            "created_at" =>$createdDate,
            "updated_at" => $createdDate,
        ];
    }
    protected $model = Driver::class;


}