<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPhotos = Image::count();

        return view('admin.dashboard', compact('totalUsers', 'totalPhotos'));
    }

    // USER
    public function listUsers()
    {
        $users = User::all();
        return view('admin.manageUsers', compact('users'));
    }
    public function showUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }
    public function editUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->update($request->all());
        $user->updated_at = now();
        $user->save();
        return response()->json($user);
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }

    // PHOTO
    public function listPhotos()
    {
        $photos = Image::all();
        return view('admin.managePhotos', compact('photos'));
    }
    public function showPhoto($id)
    {
        $photo = Image::find($id);
        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }
        return response()->json($photo);
    }
    public function editPhoto(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:25',
            'description' => 'nullable|string',
            'photo_date' => 'nullable|date',
        ]);

        $photo = Image::find($id);
        $photo->update($request->all());
        $photo->updated_at = now();
        $photo->save();
        
        return response()->json(['success' => true, 'photo' => $photo]);
    }
}
