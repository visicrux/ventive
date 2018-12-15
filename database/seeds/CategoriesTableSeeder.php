<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('categories')->insert([
            'parent_id' => 0,
            'category_title' => "Phone",
            'status' => 1,
            'created_by' => 1,
            'modified_by' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 0,
            'category_title' => "Car",
            'status' => 1,
            'created_by' => 1,
            'modified_by' => 1,
        ]);

        DB::table("categories")->insert([
            'parent_id' => 1,
            'category_title' => "Telephone",
            'status' => 1,
            'created_by' => 1,
            'modified_by' => 1,
        ]);

        DB::table("categories")->insert([
            'parent_id' => 1,
            'category_title' => "Mobile",
            'status' => 1,
            'created_by' => 1,
            'modified_by' => 1,
        ]);
    }

}
