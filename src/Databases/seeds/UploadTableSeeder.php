<?php
namespace Laracore\Core\Databases\seeds;

use DB;
use Illuminate\Database\Seeder;

class UploadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_uploads')->insert([
            'uid' 	    => 0,
            'name' 		=> 'avatar.jpeg',
            'path' 		=> '/core/img/avatar.jpeg',
            'extension' => 'jpg',
            'size' 		=> '138066',
            'md5' 		=> '459107c3da2bc989f6496ee94f390350',
            'sha1' 		=> '62f0309e8a6dbe349c57eeb2ba420bbcdf589302',
            'disk' 		=> 'public',
            'download' 	=> 0,
            'status'  	=> 'open',
            'sort' 	=> 0,
        ]);
    }
}
