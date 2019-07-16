<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\artikel;
class artikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel= artikel::all();
        if(count($artikel)<=0){
            $respons = [
                'success'=>false,
                'data' => 'Empety',
                'message' => 'artikel tidak ditemukan'
            ];
            return response()->json($respons, 404);
        }
            $respons = [
                'success'=>true,
                'data' => 'Empety',
                'message' => 'Berhasil geis'
            ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = validator::make($input,[
            'nama'=>'required|min:5'
        ]);
        if($validator->fails()){
            $response=[
                'succes'=>false,
                'data'=>'validator Error',
                'message' => $validator->error()
            ];
            return response()->json($response,500);
        }
        $artikel=tagartikel::create($input);

        $response = [
            'succes'=>true,
            'data'=>'validator Error',
            'message'=>'artikel berhasil d tambahkan'
        ];

        return response()->json($response,404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artikel= artikel::Find($id);
        if(!tag){
            $response = [
            'succes'=>false,
            'data'=>'Empty',
            'message'=>'tidak d temukan'
            ];
            return response()->json($response,200);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $artikel = Artikel::Find($id);
        $input = $request->all();

        if (!$artikel) {
            $response = [
                'success' => false,
                'data' => 'Validator Error. ',
                'message' => 'artikel tidak ditemukan'
            ];
            return response()->json($response, 404);
    }

    $validator = Validator::make($input, [
        'nama' => 'required|min:5'
    ]);

    if ($validator->fails()) {
        $response = [
            'success' => false,
            'data' => 'Validation Error. ',
            'message' => $validator->errors()
        ];
        return response()->json($respons, 500);
    }
    $artikel->nama=$input['nama'];
    $artikel->save();
    $respons = [
        'success' => true,
        'data' => $artikel,
        'message' => 'artikel berhasil ditambahkan.'
    ];
    return response()->json($respons, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artikel = Kategori::find($id);

        if($artikel) {
        $respons = [
            'success' => false,
            'data' => 'Empety',
            'message' => 'artikel tidak ditemukan'
        ];
        return response()->json($respons, 404);
        }
        $artikel->delete();
        $respons = [
            'success' => true,
            'data' => $artikel,
            'message' => 'artikel berhasil dihapus.'
        ];
        return response()->json($respons, 200);
    }
}
