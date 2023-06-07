<?php


use App\Domains\Drivers\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\putJson;
use function Pest\Laravel\patchJson;

uses(TestCase::class, RefreshDatabase::class);
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\put;
use function PHPUnit\Framework\assertEquals;

use function PHPUnit\Framework\assertNotNull;

it('drivers/ GET', function () {
    $response = get('/api/v1/drivers');

    $response->assertStatus(200);

    $response->assertJson(function (AssertableJson $json) {
        $json->has('data');
    });
});

it('drivers/{id} GET correct id', function() {
    $shop = Driver::factory()->createOne();

    $response = get('/api/v1/drivers/' . $shop->id);
    $response->assertStatus(200);

    $json = $response->decodeResponseJson()['data'];
    assertEquals($shop->full_name, $json['full_name']);
    assertEquals($shop->car_name, $json['car_name']);
    assertEquals($shop->car_type, $json['car_type']);

    $shop->delete();
});

it('drivers/ POST correct data', function() {
    $response = $this->postJson('/api/v1/drivers', [
        "full_name" => 'IVAN',
        "car_name" => 'KIO',
        "car_type" => 1,
    ]);
    $response->assertStatus(201);

    $shop = Driver::query(
        )->where(
            'full_name', '=', 'IVAN'
        )->where(
            'car_name', '=', 'KIO'
        )->where(
            'car_type', '=', 1
        )->first();
    assertNotNull($shop);

    $shop->delete();
});

it('drivers/{id} PUT incorrect id', function () {
    $driver = Driver::factory()->createOne();
    $driver->save();

    $response = $this->putJson('/api/v1/drivers/-1', [
        "full_name" => 'IVAN',
        "car_name" => 'KIO',
        "car_type" => 1,
    ]);
    $response->assertStatus(404);


    $driver->delete();
});

it('drivers/{id} PATCH correct id', function () {


    $driver = new Driver([
        "full_name" => 'IVAN',
        "car_name" => 'KIO',
        "car_type" => 1,
    ]);
    $driver->save();

    $response = $this->patchJson('/api/v1/drivers/' . $driver->id, [
        'entry_name' => 'вечер'
    ]);
    $response->assertStatus(200);

    $json = $response->decodeResponseJson();
    $data = $json['data'];

    $driver = Driver::query()->find($data['id']);
    assertEquals('IVAN', $driver->full_name);
    assertEquals('KIO', $driver->car_name);
    assertEquals(1, $driver->car_type);

    $driver->delete();
    $driver->delete();
});

