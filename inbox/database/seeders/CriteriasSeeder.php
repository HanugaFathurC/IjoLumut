<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Criteria;

class CriteriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteriasData = [
            [
                'name' => 'Quantity',
                'weight' => 0.3,
                'attribute' => 'Benefit',
            ],
            [
                'name' => 'Duration',
                'weight' => 0.3,
                'attribute' => 'Benefit',
            ],
            [
                'name' => 'Price',
                'weight' => 0.4,
                'attribute' => 'Benefit',
            ],
        ];

        foreach ($criteriasData as $data) {
            Criteria::create($data);
        }
    }
}
