<?php

// namespace DB\Seeds;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'password' => bcrypt('secret'),
            'password_confirmed' => 1,
            'email' => 'test@test.test',
            'name' => 'Test',
            'surname' => 'Tester',
            'date' => date('2013-11-15'),
            'image_url' => 'someUrl',
            'notifications' => true,
            'about_me' => 'some info',
            'interests' => '{"sport","movie"}'
        ]);

        User::create([
            'password' => bcrypt(123456),
            'password_confirmed' => 0,
            'email' => 'Testuser@Testuser.com',
            'name' => 'Testuser',
            'surname' => 'Testuser',
            'date' => date('2013-11-15'),
            'image_url' => 'someUrl2',
            'notifications' => true,
            'about_me' => 'some other info2',
            'interests' => '{"sport","movie"}'
        ]);
    }
}