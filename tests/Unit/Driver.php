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