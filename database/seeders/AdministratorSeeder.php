<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new user();
        $admin->username = "administrator";
        $admin->name     = "Site Administrator";
        $admin->email    = "admin@larashop.test";
        $admin->roles    = json_encode(["ADMIN"]);
        $admin->password = \Hash::make("larashop");
        $admin->avatar   = "default.jpg";
        $admin->address  = "Padang Sumatera Barat";
        $admin->save();

        $this->command->info("Data Berhasil ditambahkan");
    }
}
