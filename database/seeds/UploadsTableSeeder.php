<?php

use Illuminate\Database\Seeder;

class UploadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('uploads')->delete();

        factory(App\Uploads::class,100)->create();
    }
}