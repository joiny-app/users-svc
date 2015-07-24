<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class User extends Model
{
    
     protected $fillable = ['login', 'password', 'password_confirm', 'email', 'name', 'surname', 'date', 'image_url', 'notifications', 'about_me', 'interest'];
    
}