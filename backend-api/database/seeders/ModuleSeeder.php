<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
// database/seeders/ModuleSeeder.php
    public function run()
    {
        Module::factory(5)->state(new Sequence(
            ['name' => 'URL Shortener', 'description' => 'Raccourcir et gérer des liens'],
            ['name' => 'Wallet', 'description' => 'Gestion du solde et transferts'],
            ['name' => 'Marketplace', 'description' => 'Gestion de produits et commandes'],
            ['name' => 'Time Tracker', 'description' => 'Suivi du temps et sessions'],
            ['name' => 'Investment Tracker', 'description' => 'Suivi du portefeuille d’investissement'],
        ))->create();
    }
}
