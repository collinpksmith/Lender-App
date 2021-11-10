<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::factory()
            ->times(10)
            ->create()
            ->each(function ($team) {
                $players = Player::factory()
                    ->count(10)
                    ->make();

                $team->players()->saveMany($players);
            });
    }
}
