<?php
use App\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Angelo';
        $user->email = 'abstractplayer@gmail.com';
        $user->password = '$2y$10$7/FSVI0JcOglJF720i0Mnu1U.hqSPKS0fmZocgNR/Vxaqk03rhhhW';
        $user->save();
    }
}
