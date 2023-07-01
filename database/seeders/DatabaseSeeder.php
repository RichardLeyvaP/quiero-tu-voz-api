<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Helpers\FieldsOptions\RoleFieldOptions;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $country = Country::create([
            'name' => 'Brasil'
        ]);

        $city = City::create([
            'country_id' => $country->id,
            'name' => 'Brasilia'
        ]);

        $user = User::create([
            'city_id' => $city->id,
            'name' => 'Administrador',
            'last_name' => 'del Sistema',
            'email' => 'admin@locutoresassociados.com',
            'password' => Hash::make('admin'),
            'role' => RoleFieldOptions::ADMIN->value,
        ]);
    }
}
