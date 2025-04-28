<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'ammar yasser',
            'email' => 'ammar@gmail.com',
            'password' => bcrypt('101205')
        ]);
    }
}
