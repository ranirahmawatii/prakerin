<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tag;
use Session;

class tagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = tag::orderBy('created_at', 'desc')->get();
       return view('backend.tag.index',compact('tag'));
        //    $tag = tag::all();
        // if(count ($tag) <=0 ) {
        //     $response = [
        //         'success' =>false,
        //         'data' => 'Empety',
        //         'message' => 'tag tdk ditemukan.'
        //     ];
        //       return response()->json($response,404);
        // }
        //  $response = [
        //         'success' =>true,
        //         'data' => $tag,
        //         'message' => 'berhasil'
        //     ];
        //     return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $tag = tag::all();
        return view('backend.tag.create',compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $tag = new tag();
        $tag->nama_tag = $request->nama_tag;
        $tag->slug = str_slug($request->nama_tag, '-');
        $tag->save();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menyimpan tag <b>$tag->nama_tag</b>!"
        ]);

        return redirect()->route('tag.index');
        //   // 1. tembung semua inputan ke $input
        // $input = $request->all();

        // // 2. buat validasi di tambung ke $validator
        // $validator = Validator::make($input, [
        //     'nama' => 'required|min:5'
        // ]);

        // //3. cek validasi
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'data' => 'Validator Error,',
        //         'message' => $validator->errors()
        //     ];
        //     return response()->json($response,500);
        // }

        // //4. buat fungsi untuk menghandle semua inputan ->dimasukan ketable
        // $tag = new tag;
        // $tag->nama_tag = $request->nama_tag;
        // $kategori->slug = str_slug($request->nama_tag, '-');
        // $tag->save();

        // //5. menampilkan response
        // $response = [
        //     'success' => true,
        //     'data' => $tag,
        //     'message' => 'tag Berhasil ditambahkan.'
        // ];

        // //6. tampilkan hasil
        // return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

         $tag = tag::findOrFail($id);
        return view('backend.tag.show',compact('tag'));

        //  $tag = tag::find($id);
        // if(!$tag) {
        //     $response = [
        //         'success' =>false,
        //         'data' => 'Empty',
        //         'message' => 'tag tdk d temukan'
        //     ];
        //     return response()->json($response,404);
        // }
        //  $response = [
        //         'success' =>true,
        //         'data' => $tag,
        //         'message' => 'berhasil'
        //     ];
        //       return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $tag = tag::findOrFail($id);
        return view('backend.tag.edit',compact('tag'));
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

         $request->validate([
            'nama_tag'=>'required',
        ]);
         $tag = tag::findOrFail($id);
        $tag->nama_tag = $request->nama_tag;
        $tag->slug = str_slug($request->nama_tag, '-');
        $tag->save();
        Session::flash("flash_notification",[
        "level"=>"primary",
        "message"=>"berhasil mengubah tag<b> $tag->nama_tag</b>!"
        ]);
        return redirect()->route('tag.index');
        //  $tag = tag::find($id);
        //     $input = $request->all();

        //     if(!$tag) {
        //         $response = [
        //             'success' =>false,
        //             'data' => 'Empety',
        //             'message' => 'tag tdk d temukan'
        //         ];
        //         return response()->json($response,404);
        //     }
        //     $validator = Validator::make($input, [
        //         'nama' => 'required|min:5'
        //     ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'data' => 'Validator Error,',
        //         'message' => $validator->errors()
        //     ];
        //     return response()->json($response,500);
        //     }
        //     $tag->nama =$input['nama'];
        //     $tag->save();
        //     $response = [
        //             'success' => true,
        //             'data' => $tag,
        //             'message' => 'tag Berhasil ditambahkan.'
        //         ];
        //         return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    $tag = tag::findOrfail($id);
    $tag->nama_tag;
    $tag->delete();
      return redirect()->route('tag.index');
        //   $tag = tag::find($id); 

        //     if(!$tag) {
        //     $response = [
        //         'success' =>false,
        //         'data' => 'Empety',
        //         'message' => 'tag tdk d temukan'
        //     ];
        //      return response()->json($response,404);
        //     }
        //     $tag->delete();
        //     $response = [
        //         'success' => true,
        //         'data' => $tag,
        //         'message' => 'tag berhasil d hps.'
        //     ];
        //     return response()->json($response,200);
    }
}
