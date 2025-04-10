<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Option;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $climateControl = Option::create(['name' => 'Климат контроль']);
        $laserOptics = Option::create(['name' => 'Лазерные фары']);
        $disks = Option::create(['name' => 'Кованые диски']);
        $roseSelector = Option::create(['name' => 'Розочка на селектор КПП']);

        $granta = Car::create(['name' => 'Лада Приора']);
        $vesta = Car::create(['name' => 'Лада Веста']);

        $GrantaComfort = $granta->configurations()->create(['name' => 'Комфорт']);
        $GrantaPremium = $granta->configurations()->create(['name' => 'Премиум']);

        $GrantaComfort->options()->attach([$climateControl->id, $laserOptics->id]);
        $GrantaPremium->options()->attach([$climateControl->id, $laserOptics->id, $disks->id]);

        $GrantaComfort->prices()->create([
            'price' => 1200_000,
            'start_date' => now()->subMonth(),
            'end_date' => now()->addMonth(),
        ]);

        $GrantaPremium->prices()->create([
            'price' => 1500_000,
            'start_date' => now()->subWeek(),
            'end_date' => null,
        ]);

        $vestaBase = $vesta->configurations()->create(['name' => 'Базовая']);
        $vestaSport = $vesta->configurations()->create(['name' => 'Спорт']);

        $vestaBase->options()->attach([$climateControl->id]);
        $vestaSport->options()->attach([$climateControl->id, $disks->id, $roseSelector->id]);

        $vestaBase->prices()->create([
            'price' => 1500_000,
            'start_date' => now()->subDays(5),
            'end_date' => now()->addDays(10),
        ]);

        $vestaSport->prices()->create([
            'price' => 1700_000,
            'start_date' => now()->subDays(2),
            'end_date' => null,
        ]);
    }
}
