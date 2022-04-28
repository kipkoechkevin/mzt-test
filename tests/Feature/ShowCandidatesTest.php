<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\Company;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowCandidatesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function list_of_candidates_shows_on_the_candidates_and_coins_page()
    {
        $candidate1 = Candidate::factory()->create([
            'name' => 'Mr Darcy',
            'email' => 'darcy@example.com',
            'description' => 'A back-end developer',
            'strengths' => json_encode(['Laravel', 'Node', 'C#']),
        ]);
        $candidate2 = Candidate::factory()->create([
            'name' => 'Jane Austin',
            'email' => 'john@example.com',
            'description' => 'A back-end developer',
            'strengths' => json_encode(['Laravel', 'Node', 'C#']),
        ]);
        $wallet = Wallet::factory()->create([
            'coins' => 20,
            'company_id' => 1,
        ]);
        $company = Company::factory()->create([
            'name' => 'The Remote Company',
        ]);

        $coins = $company->wallet->coins;

        $response = $this->get('/candidates-list');

        $response->assertSuccessful();

        $response->assertSee($candidate1->name);
        $response->assertSee($candidate1->email);

        $response->assertSee($candidate2->name);
        $response->assertSee($candidate2->email);

        $response->assertSee($wallet->coins);
    }

}
