<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call('UsersTableSeeder');
        $this->call('ProductsTableSeeder');
        $this->call('WishlistsTableSeeder');
    }
}
