<?php

namespace Tests\Feature;

use App\Models\Flat;
use App\Models\Neighborhood;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlatsTest extends TestCase
{
    use RefreshDatabase;
    
    public function testUnAutheticated()
    {
        $response = $this->get(route('flats.index', [], false));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function testAuthenticated()
    {    
        $response = $this->createAuthenticatedResponse()
            ->get(route('flats.index', [], false));

        $response->assertStatus(200);
    }

    public function testCreate()
    {   
        $response = $this->createAuthenticatedResponse()
            ->get(route('flats.create', [], false));

        $response->assertStatus(200);
    }

    public function testStoreValidation()
    {    
        $response = $this->createAuthenticatedResponse()
            ->post(route('flats.store', false), []);

        $response->assertInvalid([
            'name', 'location'
        ]);

        $response->assertStatus(302);
    }

    public function testStoreValidationName()
    {    
        $response = $this->createAuthenticatedResponse()
            ->post(route('flats.store', false), [
                'location' => 'Location'
            ]);

        $response->assertInvalid([
            'name'
        ]);

        $response->assertStatus(302);
    }

    public function testStoreValidationLocation()
    {    
        $response = $this->createAuthenticatedResponse()
            ->post(route('flats.store', false), [
                'name' => 'Name'
            ]);

        $response->assertInvalid([
            'location'
        ]);

        $response->assertStatus(302);
    }

    public function testStoreValidationNeighborhoodId()
    {    
        $response = $this->createAuthenticatedResponse()
            ->post(route('flats.store', false), [
                'name' => 'Name',
                'location' => 'location',
                'neighborhood_id' => 'wrong'
            ]);

        $response->assertInvalid([
            'neighborhood_id'
        ]);

        $response->assertStatus(302);
    }

    public function testEditNotFound()
    {
        $response = $this->createAuthenticatedResponse()
            ->get(route('flats.edit', 100000000, false));

        $response->assertStatus(404);
    }

    public function testEdiFound()
    {
        $flat = Flat::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->get(route('flats.edit', $flat->id, false));

        $response->assertStatus(200);
    }

    public function testUpdateValidation()
    {    
        $flat = Flat::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('flats.update', $flat->id, false), [

            ]);

        $response->assertInvalid([
            'name', 'location'
        ]);
    }

    public function testUpdateValidationName()
    {    
        $flat = Flat::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('flats.update', $flat->id, false), [
                'location' => 'Location'
            ]);

        $response->assertInvalid([
            'name'
        ]);
    }

    public function testUpdateValidationLocation()
    {    
        $flat = Flat::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('flats.update', $flat->id, false), [
                'name' => 'Name'
            ]);

        $response->assertInvalid([
            'location'
        ]);
    }

    public function testUpdateValidationNeighborhood()
    {    
        $flat = Flat::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('flats.update', $flat->id, false), [
                'name' => 'Name',
                'location' => 'Location',
                'neighborhood_id' => 'wrong'
            ]);

        $response->assertInvalid([
            'neighborhood_id'
        ]);
    }

    public function testStore()
    {   
        $neighborhood = Neighborhood::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->post(route('flats.store', [
                'name' => 'Name',
                'location' => 'Location',
                'neighborhood_id' => $neighborhood->id,
            ], false));

        $response->assertStatus(302);
        $response->assertRedirect(route('flats.index'));
    }

    public function testUpdateNotFound()
    {   
        $neighborhood = Neighborhood::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('flats.update', 10000000, false), [
                'name' => 'Name',
                'location' => 'Location',
                'neighborhood_id' => $neighborhood->id,
            ]);

        $response->assertStatus(404);
    }

    public function testUpdateFound()
    {   
        $neighborhood = Neighborhood::factory()->create();
        $flat = Flat::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('flats.update', $flat->id, false), [
                'name' => 'Name',
                'location' => 'Location',
                'neighborhood_id' => $neighborhood->id,
            ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('flats.index'));
    }

    public function testDeleteNotFound()
    {
        $response = $this->createAuthenticatedResponse()
            ->delete(route('flats.destroy', 100000000, false));

        $response->assertStatus(404);
    }

    public function testDeleteFound()
    {   
        $flat = Flat::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->delete(route('flats.destroy', $flat->id, false));

        $response->assertStatus(302);
        $response->assertRedirect(route('flats.index'));
    }

    private function createAuthenticatedResponse()
    {
        return $this->actingAs(User::factory()->create());
    }
}
