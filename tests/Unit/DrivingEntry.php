<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Domains\Drivers\Models\Driver;
use App\Domains\DrivingEntries\Models\DrivingEntry;
use Illuminate\Testing\Fluent\AssertableJson;

uses(TestCase::class, RefreshDatabase::class);

use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function PHPUnit\Framework\assertEquals;

it('driving-entries/ GET', function () {
    $response = get('/api/v1/driving-entries');

    $response->assertStatus(200);

    $response->assertJson(function (AssertableJson $json) {
        $json->has('data');
    });
});

it('driving-entries/{id} GET correct id', function () {
    $driver = Driver::factory()->createOne();
    $driver->save();
    $dateTime = new DateTime();
    $drivingEntry = new DrivingEntry([
        'entry_name' => 'вечер понедельник',
        'student_name' => 'Петр',
        'price' => 2000,
        'status' => 1,
        'entry_start' => '2023-05-29T22:09:59Z',
        'entry_end' => '2023-05-29T22:09:59Z',
        'driver_id' => $driver->id,

    ]);
    $drivingEntry->save();

    $response = get('/api/v1/driving-entries/' . $drivingEntry->id);
    $json = $response->decodeResponseJson();
    $data = $json['data'];

    assertEquals($drivingEntry->entry_name, $data['entry_name']);
    assertEquals($drivingEntry->student_name, $data['student_name']);
    assertEquals($drivingEntry->price, $data['price']);
    assertEquals($drivingEntry->driver->id, $data['driver_id']);

    $drivingEntry->delete();
    $driver->delete();
});

it('driving-entries/{id} GET incorrect id', function () {
    $response = get('/api/v1/driving-entries/-1');
    $response->assertStatus(404);

    $json = $response->decodeResponseJson();
    assertEquals(404, $json['code']);
});

it('driving-entries/ POST correct data', function () {
    $driver = Driver::factory()->createOne();
    $driver->save();
    $dateTime = new DateTime();

    $response = $this->postJson('/api/v1/driving-entries', [
        'entry_name' => 'вечер понедельник',
        'student_name' => 'Петр',
        'price' => 2000,
        'status' => 1,
        'entry_start' => '2023-05-29T22:09:59Z',
        'entry_end' => '2023-05-29T22:09:59Z',
        'driver_id' => $driver->id,
    ]);
    $response->assertStatus(201);

    $json = $response->decodeResponseJson();
    $data = $json['data'];

    $drivingEntry = DrivingEntry::query()->find($data['id']);
    assertEquals("Fender Tele5", $drivingEntry->name);
    assertEquals(1987, $drivingEntry->manufacture_year);
    assertEquals("telecaster", $drivingEntry->shape);
    assertEquals($driver->id, $drivingEntry->driver_id);

    $drivingEntry->delete();
    $driver->delete();
});

it('driving-entries/ POST shape validation', function () {
    $driver = Driver::factory()->createOne();
    $driver->save();

    $response = $this->postJson('/api/v1/driving-entries', [
        'entry_name' => 'вечер понедельник',
        'student_name' => 'Петр',
        'status' => 1,
        'driver_id' => $driver->id,
    ]);
    $response->assertStatus(400);

    $driver->delete();
});

it('driving-entries/{id} DELETE correct id', function () {
    $driver = Driver::factory()->createOne();
    $driver->save();
    $dateTime = new DateTime();

    $drivingEntry = new DrivingEntry([
        'entry_name' => 'вечер понедельник',
        'student_name' => 'Петр',
        'price' => 2000,
        'status' => 1,
        'entry_start' => '2023-05-29T22:09:59Z',
        'entry_end' => '2023-05-29T22:09:59Z',
        'driver_id' => $driver->id,
    ]);
    $drivingEntry->save();

    $response = delete('/api/v1/driving-entries/' . $drivingEntry->id);
    $response->assertStatus(200);

    $found_driving_entry = DrivingEntry::query()->find($drivingEntry->id);
    assertEquals(null, $found_driving_entry);

    $driver->delete();
});

it('driving-entries/{id} DELETE incorrect id', function () {
    $response = delete('/api/v1/driving-entries/-1');
    $response->assertStatus(404);

    $json = $response->decodeResponseJson();
    assertEquals(404, $json['code']);
});

it('driving-entries/{id} PUT correct id', function () {
    $driver = Driver::factory()->createOne();
    $driver->save();
    $dateTime = new DateTime();

    $drivingEntry = new DrivingEntry([
        'entry_name' => 'вавфык',
        'student_name' => 'фыва',
        'price' => 2000,
        'status' => 1,
        'entry_start' => '2023-05-29T22:09:59Z',
        'entry_end' => '2023-05-29T22:09:59Z',
        'driver_id' => $driver->id,
    ]);
    $drivingEntry->save();

    $driver1 = Driver::factory()->createOne();
    $driver1->save();
    $dateTime = new DateTime();

    $response = $this->putJson('/api/v1/driving-entries/' . $drivingEntry->id, [
        'entry_name' => 'вечер понедельник',
        'student_name' => 'Петр',
        'price' => 2000,
        'status' => 1,
        'entry_start' => '2023-05-29T22:09:59Z',
        'entry_end' => '2023-05-29T22:09:59Z',
        'driver_id' => $driver->id,
    ]);
    $response->assertStatus(200);

    $json = $response->decodeResponseJson();
    $data = $json['data'];

    $drivingEntry = DrivingEntry::query()->find($data['id']);
    assertEquals('Петр', $drivingEntry->student_name);
    assertEquals('вечер понедельник', $drivingEntry->entry_name);
    assertEquals(2000, $drivingEntry->price);
    assertEquals($driver->id, $drivingEntry->driver_id);


    $driver1->delete();
    $drivingEntry->delete();
    $driver->delete();
});

it('driving-entries/{id} PUT incorrect id', function () {
    $driver = Driver::factory()->createOne();
    $driver->save();

    $response = $this->putJson('/api/v1/driving-entries/-1', [
        'entry_name' => 'вечер понедельник',
        'student_name' => 'Петр',
        'price' => 2000,
        'status' => 1,
        'entry_start' => '2023-05-29T22:09:59Z',
        'entry_end' => '2023-05-29T22:09:59Z',
        'driver_id' => $driver->id,
    ]);
    $response->assertStatus(404);


    $driver->delete();
});

it('driving-entries/{id} PATCH correct id', function () {
    $driver = Driver::factory()->createOne();
    $driver->save();
    $dateTime = new DateTime();

    $drivingEntry = new DrivingEntry([
        'entry_name' => 'вечер понедельник',
        'student_name' => 'Петр',
        'price' => 2000,
        'status' => 1,
        'entry_start' => '2023-05-29T22:09:59Z',
        'entry_end' => '2023-05-29T22:09:59Z',
        'driver_id' => $driver->id,
    ]);
    $drivingEntry->save();

    $response = $this->patchJson('/api/v1/driving-entries/' . $drivingEntry->id, [
        'entry_name' => 'вечер'
    ]);
    $response->assertStatus(200);

    $json = $response->decodeResponseJson();
    $data = $json['data'];

    $drivingEntry = DrivingEntry::query()->find($data['id']);
    assertEquals('Петр', $drivingEntry->student_name);
    assertEquals('вечер', $drivingEntry->entry_name);
    assertEquals(2000, $drivingEntry->price);
    assertEquals($driver->id, $drivingEntry->driver_id);

    $drivingEntry->delete();
    $driver->delete();
});

it('driving-entries/{id} PATCH incorrect id', function () {
    $response = patch('/api/v1/driving-entries/-1');
    $response->assertStatus(404);

    $json = $response->decodeResponseJson();
    assertEquals(404, $json['code']);
});