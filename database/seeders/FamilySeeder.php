<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      [
        'name' => 'Budi', // id: 1
        'gender' => 'Male',
      ],
      [
        'name' => 'Dedi', // id: 2
        'gender' => 'Male',
        'parent_id' => 1,
      ],
      [
        'name' => 'Dodi', // id: 3
        'gender' => 'Male',
        'parent_id' => 1,
      ],
      [
        'name' => 'Dede', // id: 4
        'gender' => 'Male',
        'parent_id' => 1,
      ],
      [
        'name' => 'Dewi', // id: 5
        'gender' => 'Female',
        'parent_id' => 1,
      ],
      [
        'name' => 'Feri',
        'gender' => 'Male',
        'parent_id' => 2,
      ],
      [
        'name' => 'Farah',
        'gender' => 'Female',
        'parent_id' => 2,
      ],
      [
        'name' => 'Gugus',
        'gender' => 'Male',
        'parent_id' => 3,
      ],
      [
        'name' => 'Gandi',
        'gender' => 'Male',
        'parent_id' => 3,
      ],
      [
        'name' => 'Hani',
        'gender' => 'Female',
        'parent_id' => 4,
      ],
      [
        'name' => 'Hana',
        'gender' => 'Female',
        'parent_id' => 4,
      ],
    ];

    collect($items)->each(function (&$item) {
      $item['created_at'] = $item['updated_at'] = now();
      Family::firstOrCreate($item);
    });
  }
}
