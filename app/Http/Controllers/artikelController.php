<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kategori;
use App\tag;
use App\artikel;
use Session;
use Auth;
use File;
use App\User;

use Illuminate\Queue\Jobs\SyncJob;

class artikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $artikel = artikel::orderBy('created_at', 'desc')->get();
        return view('backend.artikel.index', compact('artikel', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori::all();
        $tag = tag::all();
        return view('backend.artikel.create', compact('kategori', 'tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //   $request->validate([
    //       'judul' => 'required|unique:artikels',
    //       'konten' => 'required',
    //       'foto' => 'required|mimes:jpeg.jpg.png.gif|required|max:2048',
    //            'id_kategori' => 'required',
    //       'id_tag' => 'required']);
    

        $artikel = new artikel();
        $artikel->judul = $request->judul;
        $artikel->slug = str_slug($request->judul);
        $artikel->konten = $request->konten;
        $artikel->id_user = Auth::user()->id;
        $artikel->id_kategori = $request->kategori;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destinationPath = public_path() . '/assets/img/artikel/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);
            $artikel->foto = $filename;
        }

        $artikel->save();
        $artikel->tag()->attach($request->tag);
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan data artikel berjudul <b>$artikel->judul</b>!"
        ]);
        return redirect()->route('artikel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artikel = artikel::findOrFail($id);
        $tag = tag::all();
        $kategori = kategori::all();
        $selected = $artikel->tag->pluck('id')->toArray();
        return view('backend.artikel.show', compact('artikel', 'selected', 'tag', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = artikel::findOrFail($id);
        $kategori = kategori::all();
        $tag = tag::all();
        $selected = $artikel->tag->pluck('id')->toArray();
        return view('backend.artikel.edit', compact('artikel', 'selected', 'kategori', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    //   $request->validate([
    //       'judul' => 'required|unique:artikels',
    //       'konten' => 'required|min:50',
    //       'foto' => 'required|mimes:jpeg.jpg.png.gif|required|max:2048',
    //       'id_kategori' => 'required',
    //       'id_tag' => 'required']);

        $artikel = artikel::findOrFail($id);
        $artikel->judul = $request->judul;
        $artikel->slug = str_slug($request->judul);
        $artikel->konten = $request->konten;
        $artikel->id_user = Auth::user()->id;
        $artikel->id_kategori = $request->id_kategori;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destinationPath = public_path() . '/assets/img/artikel/';
            $filename = str_random(6) . '_' . '/assets/img/artikel/';
            $upload = $file->move($destinationPath, $filename);
        }

        if ($artikel->foto) {
            $old_foto = $artikel->foto;
            $filepath = public_path() . '/assets/img/' . $artikel->foto;
            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) { }

            $artikel->save();
            $artikel->tag()->sync($request->tag);
            Session::flash("flash_notification", [
                "level" => "primary",
                "message" => "Berhasil mengubah data artikel berjudul <b>$artikel->judul</b>!"
            ]);
            return redirect()->route('artikel.index');
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
        $artikel = artikel::findOrFail($id);
        if ($artikel->foto) {
            $old_foto = $artikel->foto;
            $filepath = public_path() . '/assets/img/artikel/' . $artikel->foto;
            try {
                File::delete($filepath);
            } catch (FileNotFoundException $e) { }
        }

        $artikel->tag()->detach($artikel->id);
        $artikel->delete();
        Session::flash("flash_notification", [
            "level" => "danger",
            "message" => "Berhasil menghapus data artikel berjudul <b>$artikel->judul</b>!"
        ]);
        return redirect()->route('artikel.index');
    }
}
