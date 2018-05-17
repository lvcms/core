<?php
namespace Laracore\Core\Framework\Database\Seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($class)
    {
        $this->call($class);
    }
}
