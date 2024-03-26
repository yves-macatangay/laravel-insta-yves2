<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $category;

    public function __construct(Category $category){
        $this->category = $category;
    }

    public function run(): void
    {
        //insert() 
        //* you can use save(), create(), createMany()

        $categories = [
            [
                'name' => 'Theatre',
                'updated_at' => NOW(),
                'created_at' => NOW(),
            ],
            [
                'name' => 'Landscaping',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'name' => 'Hiking',
                'updated_at' => NOW(),
                'created_at' => NOW()
            ]
        ];

        $this->category->insert($categories);
    }
}
