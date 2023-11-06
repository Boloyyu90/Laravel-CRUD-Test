<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Movie; /* import model movie */

class MovieController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get movie
        $movie = Movie::latest()->paginate(5);
        //render view with posts
        return view('movie.index', compact('movie'));
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('movie.create');
    }
    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'title' => 'required',
            'director' => 'required',
            'duration' => 'required',
            'image' => 'required'
        ]);
        $file = $request->file('image');
        $image = $file->getClientOriginalName();
        $file->move(public_path('public/images'), $image);
        //Fungsi Simpan Data ke dalam Database
        Movie::create([
            'title' => $request->title,
            'director' => $request->director,
            'duration' => $request->duration,
            'image' => $image
        ]);
        try {
            return redirect()->route('movie.index');
        } catch (Exception $e) {
            return redirect()->route('movie.index');
        }
    }
    /**
     * edit
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('movie.edit', compact('movie'));
    }
    /**
     * update
     *
     * @param mixed $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);

        // Validasi Formulir
        $this->validate($request, [
            'title' => 'required',
            'director' => 'required',
            'duration' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar menjadi opsional
        ]);

        // Periksa apakah ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Jika ada gambar baru yang diunggah, unggah dan simpan gambar baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('public/images'), $imageName);

            // Hapus gambar lama jika ada
            if (file_exists(public_path('public/images/' . $movie->image))) {
                unlink(public_path('public/images/' . $movie->image));
            }

            $movie->image = $imageName;
        }

        // Update data lainnya
        $movie->title = $request->title;
        $movie->director = $request->director;
        $movie->duration = $request->duration;

        // Simpan perubahan
        $movie->save();

        return redirect()->route('movie.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        return redirect()->route('movie.index')->with(['success' => 'Data 
Berhasil Dihapus!']);
    }
}
