<?php

namespace Tests\Feature;

use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WikcupAppTest extends TestCase
{
    /**
     * Test public pages can be accessed.
     */
    public function test_public_pages_status(): void
    {
        $this->get('/')->assertStatus(200);
        $this->get('/jadwal')->assertStatus(200);
        $this->get('/hasil')->assertStatus(200);
        $this->get('/tim')->assertStatus(200);
        $this->get('/statistik')->assertStatus(200);
        $this->get('/galeri')->assertStatus(200);
        $this->get('/login')->assertStatus(200);
        $this->get('/register')->assertStatus(200);
    }

    /**
     * Test detail pages.
     */
    public function test_detail_pages_status(): void
    {
        $team = Team::first();
        if ($team) {
            $this->get('/tim/' . $team->id_team)->assertStatus(200);
        }

        $player = Player::first();
        if ($player) {
            $this->get('/pemain/' . $player->id_player)->assertStatus(200);
        }

        $match = MatchModel::first();
        if ($match) {
            $this->get('/hasil/' . $match->id_match)->assertStatus(200);
        }
    }

    /**
     * Test player authenticated routes.
     */
    public function test_player_can_access_profile(): void
    {
        $playerUser = User::where('role', 'pemain')->first();
        $this->actingAs($playerUser)
            ->get('/profil')
            ->assertStatus(200);
    }

    /**
     * Test player cannot access admin routes.
     */
    public function test_player_cannot_access_admin(): void
    {
        $playerUser = User::where('role', 'pemain')->first();
        $this->actingAs($playerUser)
            ->get('/admin')
            ->assertStatus(403);
    }

    /**
     * Test admin can access all admin routes.
     */
    public function test_admin_can_access_all_admin_routes(): void
    {
        $adminUser = User::where('role', 'admin')->first();
        
        $this->actingAs($adminUser)->get('/admin')->assertStatus(200);
        $this->actingAs($adminUser)->get('/admin/teams')->assertStatus(200);
        $this->actingAs($adminUser)->get('/admin/teams/create')->assertStatus(200);
        $this->actingAs($adminUser)->get('/admin/matches')->assertStatus(200);
        $this->actingAs($adminUser)->get('/admin/matches/create')->assertStatus(200);
        $this->actingAs($adminUser)->get('/admin/statistics')->assertStatus(200);
        $this->actingAs($adminUser)->get('/admin/statistics/create')->assertStatus(200);
        $this->actingAs($adminUser)->get('/admin/galleries')->assertStatus(200);
        $this->actingAs($adminUser)->get('/admin/galleries/create')->assertStatus(200);
    }
}
