<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public static function createNewUser($data)
    {
        $newUser = new User;
        $newUser->name = $data['name'];
        $newUser->email = $data['email'];
        $newUser->mobile = $data['mobile'];
        $password = Str::random(10);
        $newUser->password = bcrypt($password);

        $newUser->save();
        $newUser->assignRole('Customer');

        return $newUser;
    }
}
