<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Abiturent;

class AbiturentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCreateAbiturent(): void
    {
        $user = User::factory(User::class)->create();
        $response = $this->post('/abiturents', [
            'name' => 'John',
            'surname' => 'Doe',
            'gender' => 0,
            'groupNumber' => 123,
            'email' => 'john@example.com',
            'totalEge' => 400,
            'birthday' => '1990-01-01',
            'phone' => '123456789',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('abiturents', [
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john@example.com',
        ]);
    }

    public function testInvalidAbiturentCreation(): void
    {
        $response = $this->post('/abiturents', [
            'name' => '',
            'surname' => '',
            'gender' => 'asd',
            'groupNumber' => 'asd',
            'email' => 'invalid-email',
            'totalEge' => 500,
            'birthday' => 'invalid-date-format',
            'phone' => '123456789012345678900',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'surname', 'email', 'totalEge', 'birthday', 'gender', 'groupNumber', 'phone']);
    }

    /**
     * Test viewing an abiturent.
     */
    public function testViewAbiturent(): void
    {
        $abiturent = Abiturent::factory()->create();

        $response = $this->get("/abiturents/{$abiturent->id}");

        $response->assertStatus(200);
        $response->assertSee($abiturent->name);
    }

    /**
     * Test updating an abiturent.
     */
    public function testUpdateAbiturent(): void
    {
        $abiturent = Abiturent::factory()->create();
        $user = User::factory()->create([
            'email' => $abiturent->email,
        ]);

        $this->actingAs($user);


        $response = $this->put("/abiturents/{$abiturent->id}", [
            'name' => 'John',
            'surname' => 'Doe',
            'gender' => 0,
            'groupNumber' => 123,
            'email' => $abiturent->email,
            'totalEge' => 400,
            'birthday' => '1990-01-01',
            'phone' => '123456789',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('abiturents', [
            'name' => 'John',
            'surname' => 'Doe',
            'email' => $abiturent->email,
        ]);
    }

    /**
     * Test updating an abiturent with 403 Forbidden response.
     */
    public function testUpdateFunction403(): void
    {
        $abiturent = Abiturent::factory()->create();

        $response = $this->put("/abiturents/{$abiturent->id}", [
            'name' => 'John',
            'surname' => 'Doe',
            'gender' => 0,
            'groupNumber' => 123,
            'email' => $abiturent->email,
            'totalEge' => 400,
            'birthday' => '1990-01-01',
            'phone' => '123456789',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test deleting an abiturent.
     */
    public function testDeleteAbiturent(): void
    {
        $abiturent = Abiturent::factory()->create([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john@example.com',
        ]);

        $user = User::factory()->create([
            'email' => $abiturent->email,
        ]);

        $this->actingAs($user);

        $response = $this->delete("/abiturents/{$abiturent->id}");
        $response->assertStatus(302);

        $this->assertDatabaseMissing('abiturents', [
            'name' => 'John',
            'surname' => 'Doe',
            'email' => $abiturent->email,
        ]);
    }

    /**
     * Test deleting an abiturent with 403 Forbidden response.
     */
    public function testDeleteFunction403(): void
    {
        $abiturent = Abiturent::factory()->create([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john@example.com',
        ]);

        $response = $this->delete("/abiturents/{$abiturent->id}");
        $response->assertStatus(403);
    }

    public function testIndex()
    {
        $response = $this->get('/abiturents');
        $response->assertSuccessful();
        $response->assertViewHas('abiturents');
    }

    public function testIndexDefaultSort()
    {
        $response = $this->get('/abiturents');
        $response->assertViewHas('abiturents');
    }

    public function testIndexCustomSort()
    {
        $response = $this->get('/abiturents');
        $response->assertViewHas('abiturents');
        $response->assertViewHas('order', 'asc');

        $response = $this->get('/abiturents?sort=name&order=asc');
        $response->assertViewHas('abiturents');
        $response->assertViewHas('order', 'desc');
    }

    public function testIndexSearch()
    {
        $response = $this->get('/abiturents?search=John');
        $response->assertViewHas('abiturents');
    }
}
