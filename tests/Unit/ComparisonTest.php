<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Comparison;
use App\Services\BaconIpsumHandler;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComparisonTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_bacon_ipsum_handler_get_string()
    {
        $baconIpsumHandler = new BaconIpsumHandler;
        $baconString = $baconIpsumHandler->getBaconString();

        $this->assertIsString($baconString);
    }

    public function test_compare_two_fetched_strings_and_check_results()
    {
        $baconIpsumHandler = new BaconIpsumHandler;

        $baconString1 = $baconIpsumHandler->getBaconString();
        $baconString2 = $baconIpsumHandler->getBaconString();

        $matchingChars = similar_text($baconString1, $baconString2, $percentage);

        $this->assertIsString($baconString1);
        $this->assertIsString($baconString2);
        $this->assertIsInt($matchingChars);
        $this->assertIsFloat($percentage);
    }

    public function test_create_comparison_models()
    {
        Comparison::factory()->count(5)->create();

        $this->assertDatabaseCount('comparisons', 5);
    }
    
    public function test_get_similar_text_route()
    {
        $response = $this->getJson('/api/comparisons/similar-text');

        $response
            ->assertStatus(200)
            ->assertSuccessful();
    }

    public function test_get_comparisons_paginated_list_route()
    {
        $response = $this->getJson('/api/comparisons');

        $response
            ->assertStatus(200)
            ->assertSuccessful();
    }
}
