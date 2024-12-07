<?php

namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        // Ambil data gambar dari database
        $images = Image::all();

        // Kirim data ke view
        return view('album.album', compact('images'));
    }

    public function tambahAlbum() {
        return view('album.tambah');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo_date' => 'required|date',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        // Menyimpan gambar ke folder 'public/images'
        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
            // Menyimpan gambar dan mendapatkan path-nya
            $imagePath = $request->file('cover_image')->store('images', 'public');
        }

        // Menyimpan data album ke database
        $image = new Image();
        $image->title = $validatedData['title'];
        $image->description = $validatedData['description'];
        $image->photo_date = $validatedData['photo_date'];
        $image->url = $imagePath;  // Menyimpan path gambar
        $image->save(); 

        // Redirect atau response
        return redirect()->route('album.index')->with('success', 'Album berhasil ditambahkan!');
    }
}
