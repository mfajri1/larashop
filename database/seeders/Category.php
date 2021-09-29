<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelCategory;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new ModelCategory();
        $admin->name     = "Testing";
        $admin->slug    = "testing";
        $admin->image   = "default.jpg";
        $admin->save();

        $this->command->info("Data Berhasil ditambahkan");
    }
}
