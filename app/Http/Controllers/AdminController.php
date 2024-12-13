<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view ('admin.dashboard');
    }

    // USER
    public function listUsers() {
        $users = User::all();
        return view ('admin.manageUsers', compact('users'));
    }
    public function showUser($id) {
        $user = User::find($id);
        return view ('admin.showUser', compact('user'));
    }
    
    // PHOTO
    public function listPhotos() {
        $photos = Image::all();
        return view ('admin.managePhotos', compact('photos'));
    }
    public function showPhoto($id) {
    }
}
