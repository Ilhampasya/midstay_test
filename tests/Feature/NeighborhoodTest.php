<?php

namespace Tests\Feature;

use App\Models\Neighborhood;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NeighborhoodTest extends TestCase
{
    use RefreshDatabase;
    
    public function testUnAutheticated()
    {
        $response = $this->get(route('neighborhoods.index', [], false));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function testAuthenticated()
    {    
        $response = $this->createAuthenticatedResponse()
            ->get(route('neighborhoods.index', [], false));

        $response->assertStatus(200);
    }

    public function testCreate()
    {   
        $response = $this->createAuthenticatedResponse()
            ->get(route('neighborhoods.create', [], false));

        $response->assertStatus(200);
    }

    public function testStoreValidation()
    {    
        $response = $this->createAuthenticatedResponse()
            ->post(route('neighborhoods.store', false), []);

        $response->assertInvalid([
            'name', 'latitude', 'longitude'
        ]);

        $response->assertStatus(302);
    }

    public function testStoreValidationName()
    {    
        $response = $this->createAuthenticatedResponse()
            ->post(route('neighborhoods.store', false), [
                'latitude' => '6.9175',
                'longitude' => '107.6191'
            ]);

        $response->assertInvalid([
            'name'
        ]);

        $response->assertStatus(302);
    }

    public function testStoreValidationLatitude()
    {    
        $response = $this->createAuthenticatedResponse()
            ->post(route('neighborhoods.store', false), [
                'name' => 'Name',
                'longitude' => '107.6191',
                'latitude' => 'latitude'
            ]);

        $response->assertInvalid([
            'latitude'
        ]);

        $response->assertStatus(302);
    }

    public function testStoreValidationLongitude()
    {    
        $response = $this->createAuthenticatedResponse()
            ->post(route('neighborhoods.store', false), [
                'name' => 'Name',
                'latitude' => '107.6191',
                'longitude' => 'longitude'
            ]);

        $response->assertInvalid([
            'longitude'
        ]);

        $response->assertStatus(302);
    }

    public function testUpdateValidation()
    {    
        $neighborhood = Neighborhood::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('neighborhoods.update', $neighborhood->id, false), [

            ]);

        $response->assertInvalid([
            'name', 'longitude', 'latitude'
        ]);
    }

    public function testUpdateValidationName()
    {    
        $neighborhood = Neighborhood::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('neighborhoods.update', $neighborhood->id, false), [
                'latitude' => '6.9175',
                'longitude' => '107.6191'
            ]);

        $response->assertInvalid([
            'name'
        ]);
    }

    public function testUpdateValidationLatitude()
    {    
        $neighborhood = Neighborhood::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('neighborhoods.update', $neighborhood->id, false), [
                'name' => 'Name',
                'latitude' => 'latitude',
                'longitude' => '107.6191'
            ]);

        $response->assertInvalid([
            'latitude'
        ]);
    }

    public function testUpdateValidationLongitude()
    {    
        $neighborhood = Neighborhood::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('neighborhoods.update', $neighborhood->id, false), [
                'name' => 'Name',
                'longitude' => 'latitude',
                'latitude' => '107.6191'
            ]);

        $response->assertInvalid([
            'longitude'
        ]);
    }

    public function testStore()
    {   
        $response = $this->createAuthenticatedResponse()
            ->post(route('neighborhoods.store', [
                'name' => 'Name',
                'latitude' => '6.9175',
                'longitude' => '107.6191'
            ], false));

        $response->assertStatus(302);
        $response->assertRedirect(route('neighborhoods.index'));
    }

    public function testUpdateNotFound()
    {   
        $response = $this->createAuthenticatedResponse()
            ->put(route('neighborhoods.update', 1000000, false), [
                'name' => 'Name',
                'latitude' => '6.9175',
                'longitude' => '107.6191'
            ]);

        $response->assertStatus(404);
    }

    public function testUpdateFound()
    {   
        $neighborhood = Neighborhood::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->put(route('neighborhoods.update', $neighborhood->id, false), [
                'name' => 'Name',
                'latitude' => '6.9175',
                'longitude' => '107.6191'
            ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('neighborhoods.index'));
    }

    public function testDeleteFound()
    {   
        $neighborhood = Neighborhood::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->delete(route('neighborhoods.destroy', $neighborhood->id, false));

        $response->assertStatus(302);
        $response->assertRedirect(route('neighborhoods.index'));
    }

    public function testDeleteNotFound()
    {   
        $response = $this->createAuthenticatedResponse()
            ->delete(route('neighborhoods.destroy', 10000000, false));

        $response->assertStatus(404);
    }

    public function testEditFound()
    {
        $neighborhood = Neighborhood::factory()->create();

        $response = $this->createAuthenticatedResponse()
            ->get(route('neighborhoods.edit', $neighborhood->id, false));

        $response->assertStatus(200);
    }

    public function testEditNotFound()
    {
        $response = $this->createAuthenticatedResponse()
            ->get(route('neighborhoods.edit', 1000000, false));

        $response->assertStatus(404);
    }
    

    private function createAuthenticatedResponse()
    {
        return $this->actingAs(User::factory()->create());
    }
}
