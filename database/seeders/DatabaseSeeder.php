<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory(1)->create();
        \App\Models\Exam::factory(5)->state( new Sequence( 
            fn ($sequence) => [
                'title' => 'Exam'.' '.($sequence->index + 1), 
                'duration' => ($sequence->index + 1)
                ]
            )
        )->create();
        \App\Models\Quiz::factory(15)->state( new Sequence( 
            fn ($sequence) => [
                'title' => 'Quiz'.' '.($sequence->index + 1), 
                'exam_id' => rand(1, 5)]
            )
        )->create();
    }
}
