<?php
use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'=>'ayat amine',
            'email'=>'amine@gmail.com',
            'password'=>bcrypt('123456'),
            'profile_img'=>'profile_img1.jpg'
        ]);
    }
}
