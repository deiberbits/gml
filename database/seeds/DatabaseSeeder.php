<?php

use App\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->createCategories();
    }

    private function createCategories()
    {
        $categories = [
            'Cliente',
            'Proveedor',
            'Funcionario interno',
        ];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
