<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\kategori;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori= kategori::all();
        if(count($kategori)<=0){
            $respons = [
                'success'=>false,
                'data' => 'Empety',
                'message' => 'kategori tidak ditemukan'
            ];
            return response()->json($respons, 404);
        }
            $respons = [
                'success'=>true,
                'data' => '$kategori',
                'message' => 'Berhasil geis'
            ];
            return response()->json($respons, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           
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
                'data'=>'validator error',
                'message'=>$validator->error()
            ];
            return response()->json($response,500);
        }
        $kategori= new kategori;
        $kategori->nama_kategori= $request->nama_kategori;
        $kategori->slug= str_slug($request->nama_kategori,'_');
        $kategori->save();

        $kategori=kategori::create($input);
        $response=[
            'succes'=>true,
            'data'=>$kategori,
            'mwssage'=>'kategori berhasil'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori=kategori::Find($id);
        if(!$kategori){
            $response = [
            'succes'=>false,
            'data'=>'Empty',
            'message'=>'tidak d temukan'
            ];
            return response()->json($response,404);
        }
        
        $response = [
            'succes'=>false,
            'data'=>'$kategori',
            'message'=>'berhasil'
            ];
            return response()->json($response,200);
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
        $kategori = kategori::Find($id);
        $input = $request->all();

        if (!$kategori) {
            $response = [
                'success' => false,
                'data' => 'Validator Error. ',
                'message' => 'kategori tidak ditemukan'
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
    $kategori->nama=$input['nama'];
    $kategori->save();
    $respons = [
        'success' => true,
        'data' => $kategori,
        'message' => 'kategoriberhasil ditambahkan.'
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
        $kategori= Kategori::find($id);

        if($kategori) {
        $respons = [
            'success' => false,
            'data' => 'Empety',
            'message' => 'kategoritidak ditemukan'
        ];
        return response()->json($respons, 404);
        }
        $kategori->delete();
        $respons = [
            'success' => true,
            'data' => $kategori,
            'message' => 'kategoriberhasil dihapus.'
        ];
        return response()->json($respons, 200);
    }
}
