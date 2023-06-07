<?php

namespace App\Domains\DrivingEntries\Factory;

use App\Domains\Drivers\Models\Driver;
use App\Domains\DrivingEntries\Models\DrivingEntry;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class DriveEntryFactory extends Factory
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
        $driver = Driver::all()->random();

        $createdDate = $this->faker->dateTimeBetween($staretDate = '-5 years', $endDate = 'now', $timezone = null);
        return [
            "entry_name" => $name,
            "student_name" => $this->faker->text(20),
            "price" => $this->faker->randomDigit(),
            "created_at" =>$createdDate,
            "updated_at" => $createdDate,
            "status" => $this->faker->randomDigit(),
            "driver_id" => $driver->id,
            "entry_start" => $this->faker->dateTimeBetween($staretDate = '-5 years', $endDate = 'now', $timezone = null),
            "entry_end" => $this->faker->dateTimeBetween($staretDate = '-5 years', $endDate = 'now', $timezone = null),

        ];
    }
    protected $model = DrivingEntry::class;

    
}