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
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }
    public function editUser($id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }
    public function updateUser(Request $request, $id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->update($request->all());
        $user->updated_at = now();
        $user->save();
        return response()->json($user);
    }
    public function deleteUser($id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
    
    // PHOTO
    public function listPhotos() {
        $photos = Image::all();
        return view ('admin.managePhotos', compact('photos'));
    }
    public function showPhoto($id) {
    }
}
