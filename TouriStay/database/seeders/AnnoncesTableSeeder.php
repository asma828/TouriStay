<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Annonce;
use App\Models\User;
use Carbon\Carbon;

class AnnoncesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  assign users to annonces
        $userIds = User::pluck('id')->toArray();
        
        // If no users exist, create a few
        if (empty($userIds)) {
            $this->command->info('No users found. Creating sample users...');
            
            // Create 
            $user1 = User::create([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password'),
            ]);
            
            $user2 = User::create([
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => bcrypt('password'),
            ]);
            
            $userIds = [$user1->id, $user2->id];
        }
        
        // villes
        $cities = ['Casablanca', 'Rabat', 'Marrakech', 'Fes', 'Tanger', 'Agadir', 'Meknes', 'Oujda'];
        
        //  equipment options
        $equipmentOptions = [
            'Wifi, TV, Climatisation, Cuisine équipée',
            'Piscine, Jardin, Parking, Sécurité 24/7',
            'Balcon, Vue mer, Ascenseur, Cuisine',
            'TV, Wifi, Parking, Terrasse',
            'Climatisation, Chauffage, Lave-linge, Sèche-linge'
        ];
        
        // Create 15  annonces
        for ($i = 0; $i < 15; $i++) {
            // Random dates within a 6-month period
            $startDate = Carbon::now()->addDays(rand(5, 30));
            $endDate = (clone $startDate)->addDays(rand(5, 60));
            
            // Create sample images string (comma-separated list)
            $imageCount = rand(1, 5);
            $images = [];
            
            for ($j = 0; $j < $imageCount; $j++) {
                $images[] = 'annonce_' . ($i + 1) . '_image_' . ($j + 1) . '.jpg';
            }
            
            Annonce::create([
                'user_id' => $userIds[array_rand($userIds)],
                'titre' => 'Appartement ' . ($i + 1) . ' à louer à ' . $cities[array_rand($cities)],
                'description' => 'Bel appartement situé au centre-ville avec une vue magnifique. Entièrement meublé et rénové récemment. Proche des transports en commun, des commerces et des restaurants.',
                'ville' => $cities[array_rand($cities)],
                'prix' => rand(3000, 15000) + (rand(0, 9) * 100),
                'equipements' => $equipmentOptions[array_rand($equipmentOptions)],
                'disponible_du' => $startDate,
                'disponible_au' => $endDate,
                'images' => implode(',', $images),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now(),
            ]);
        }
        
        $this->command->info('15 sample annonces created successfully!');
    }
}