<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            ['name' => 'type-index'], ['name' => 'type-create'], ['name' => 'type-delete'], ['name' => 'type-update'],
            ['name' => 'category-index'], ['name' => 'category-create'], ['name' => 'category-delete'], ['name' => 'category-update'],
            ['name' => 'warehouse-index'],['name' => 'warehouse-create'],  ['name' => 'warehouse-delete'], ['name' => 'warehouse-update'],
            ['name' => 'product-index'], ['name' => 'product-create'], ['name' => 'product-delete'], ['name' => 'product-update'],
        ])->each(fn ($data) => Permission::create($data));

    }
}
