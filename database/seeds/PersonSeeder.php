<?php

use Illuminate\Database\Seeder;
use App\Person;
use App\Photo;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 5;

        $this->command->info("Creating {$count} people to example");

        $examplePeople = [
            'Linus Torvalds',
            'Bill Gates',
            'Steve Wozniak',
            'Tim Berners Lee',
            'Elon Musk',
        ];

        for ($i=0; $i < $count; $i++) {
            $id = $i + 1;
            Person::create([
                'name' => $examplePeople[$i],
                'registration' => 'D/AM-000' . $id,
            ]);
        }

        $this->command->info('People created for example!');
    }
}
