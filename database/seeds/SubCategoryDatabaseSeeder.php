<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class SubCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 10)->create([
            'parent_id' => function () {
               return $this->getRandomParentId();
            }
        ]);
    }

    private function getRandomParentId()
    {
        $parent = Category::inRandomOrder()->first();
        return ($parent && $parent->parent_id == null)? $parent->id : null;
    }

}
