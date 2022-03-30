<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Electronics',
            'Furniture',
            'Clothing',
            'Books',
            'Movies',
            'Games',
            'Toys',
        ];
        
        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
