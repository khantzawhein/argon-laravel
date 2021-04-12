<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        if (app()->environment() === 'local' || app()->environment() === 'staging') {
            $this->call([
                RoleSeeder::class,
                UserSeeder::class
            ]);
        } else {
            $this->call([
                RoleSeeder::class
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
