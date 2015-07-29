<?php

// namespace DB\Seeds;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'login' => 'test',
            'password' => 'secret',
            'password_confirm' => 'secret',
            'email' => 'test@test.test',
            'name' => 'Test',
            'surname' => 'Tester',
            'date' => date('2013-11-15'),
            'image_url' => 'someUrl',
            'notifications' => true,
            'about_me' => 'some info',
            'interest' => '{"sport","movie"}'
        ]);

        User::create([
            'login' => 'Testuser',
            'password' => '123456',
            'password_confirm' => '123456',
            'email' => 'Testuser@Testuser.com',
            'name' => 'Testuser',
            'surname' => 'Testuser',
            'date' => date('2013-11-15'),
            'image_url' => 'someUrl2',
            'notifications' => true,
            'about_me' => 'some other info2',
            'interest' => '{"sport","movie"}'
        ]);
    }
}