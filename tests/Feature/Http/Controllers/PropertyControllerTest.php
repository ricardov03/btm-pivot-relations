<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PropertyController
 */
class PropertyControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $properties = Property::factory()->count(3)->create();

        $response = $this->get(route('property.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }
}
