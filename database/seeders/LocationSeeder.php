<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = $locations = [
            [
                'name' => 'Central Park',
                'description' => 'A large public park in the heart of New York City, known for its beautiful landscapes and recreational activities.',
                'address' => 'Central Park, New York, NY 10024, USA',
                'coordinates' => '40.785091, -73.968285',
                'country' => 'USA',
                'city' => 'New York',
                'image' => '',
                'category_id' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'Eiffel Tower',
                'description' => 'An iconic iron lattice tower located on the Champ de Mars in Paris, a global cultural symbol of France.',
                'address' => 'Champ de Mars, 5 Avenue Anatole France, 75007 Paris, France',
                'coordinates' => '48.8584, 2.2945',
                'country' => 'France',
                'city' => 'Paris',
                'image' => '',
                'category_id' => 2,
                'user_id' => 1,
            ],
            [
                'name' => 'Sydney Opera House',
                'description' => 'A multi-venue performing arts center on Sydney Harbour and one of the most famous buildings in the world.',
                'address' => 'Bennelong Point, Sydney NSW 2000, Australia',
                'coordinates' => '-33.8568, 151.2153',
                'country' => 'Australia',
                'city' => 'Sydney',
                'image' => '',
                'category_id' => 3,
                'user_id' => 1,
            ],
            [
                'name' => 'Great Wall of China',
                'description' => 'An ancient series of walls and fortifications located in northern China, built to protect the Chinese states from invasions.',
                'address' => 'Huairou District, China',
                'coordinates' => '40.4319, 116.5704',
                'country' => 'China',
                'city' => 'Beijing',
                'image' => '',
                'category_id' => 4,
                'user_id' => 1,
            ],
            [
                'name' => 'Pyramids of Giza',
                'description' => 'Ancient pyramid structures in Egypt, considered one of the Seven Wonders of the Ancient World.',
                'address' => 'Al Haram, Nazlet El-Semman, Al Giza Desert, Giza Governorate, Egypt',
                'coordinates' => '29.9792, 31.1342',
                'country' => 'Egypt',
                'city' => 'Giza',
                'image' => '',
                'category_id' => 5,
                'user_id' => 1,
            ],
        ];


        foreach ($locations as $location) {Location::create($location);
        }
    }
}
