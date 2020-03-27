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
        $count = (int)$this->command->ask('How to people do you need? (default 5)', 5);

        if ($count < 5) {
            $count = 5;
            $this->command->info("The minor value for number of person need be {$count}.");
        };

        $this->command->info("Creating {$count} example people.");

        $examplePeople = [
            'Linus Torvalds',
            'Bill Gates',
            'Steve Wozniak',
            'Tim Berners Lee',
            'Elon Musk',
        ];

        for ($i=0; $i <= 4; $i++) {
            $id = $i + 1;
            Person::create([
                'name' => $examplePeople[$i],
            ]);
        }

        $this->command->info('People example created!');
    }
}
