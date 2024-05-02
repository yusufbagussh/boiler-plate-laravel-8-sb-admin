<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::latest()->paginate(10);
        return view('test.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image'       => 'required|image|mimes:png,jpg,jpeg',
            'title'       => 'required',
            'content'     => 'required',
            'religion'    => 'required',
            'gender'      => 'required',
            'description' => 'nullable', // Validasi Keterangan, bisa kosong
        ]);

        $active = $request->has('active') ? 1 : 0; // Cek apakah checkbox diaktifkan

        // Upload gambar
        $image = $request->file('image');
        $image->storeAs('public/tests', $image->hashName());

        // Simpan data
        $test = Test::create([
            'image'       => $image->hashName(),
            'title'       => $request->title,
            'content'     => $request->content,
            'religion'    => $request->religion,
            'gender'      => $request->gender,
            'active'      => $active,
            'description' => $request->description,
        ]);

        if ($test) {
            // Redirect dengan pesan sukses
            return redirect()->route('test.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            // Redirect dengan pesan error
            return redirect()->route('test.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * edit
     *
     * @param  mixed $blog
     * @return void
     */
    public function edit(Test $test)
    {
        return view('test.edit', compact('test'));
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $blog
     * @return void
     */
    public function update(Request $request, Test $test)
    {
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required'
        ]);

        //get data Blog by ID
        $test = Test::findOrFail($test->id);

        if ($request->file('image') == "") {

            $test->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/tests/' . $test->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/tests', $image->hashName());

            $test->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }

        if ($test) {
            //redirect dengan pesan sukses
            return redirect()->route('test.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('test.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = Test::findOrFail($id);
        Storage::disk('local')->delete('public/tests/' . $test->image);
        $test->delete();

        if ($test) {
            //redirect dengan pesan sukses
            return redirect()->route('test.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('test.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
