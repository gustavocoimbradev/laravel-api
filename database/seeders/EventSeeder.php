<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{

    public function run(): void
    {
        $users = User::all();
        for ($i = 0; $i < 200; $i++) {
            $user = $users->random();
            Event::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
