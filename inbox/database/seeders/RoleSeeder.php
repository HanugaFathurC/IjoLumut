<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([['name' => 'admin'],['name' => 'customer'], ['name' => 'customer-service'], ['name' => 'manajer'], ['name' => 'eksekutif-manajer']])
        ->each(fn ($data) => Role::create($data));
    }
}
