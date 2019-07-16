<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\tag;
class tagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag= tag::all();
        if(count($tag)<=0){
            $respons = [
                'success'=>false,
                'data' => 'Empety',
                'message' => 'tag tidak ditemukan'
            ];
            return response()->json($respons, 404);
        }
            $respons = [
                'success'=>true,
                'data' => '$rag',
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
                'data'=>'validator error',
                'message'=>$validator->error()
            ];
            return response()->json($response,500);
        }
        $tag= new tag;
        $tag->nama_tag= $request->nama_tag;
        $tag->slug= str_slug($request->nama_tag,'_');
        $tag->save();

        $tag=tag::create($input);
        $response=[
            'succes'=>true,
            'data'=>$tag,
            'mwssage'=>'tag berhasil'
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
        $tag= tag::Find($id);
        if(!tag){
            $response = [
            'succes'=>false,
            'data'=>'Empty',
            'message'=>'tidak d temukan'
            ];
            return response()->json($response,404);
        }
        
        $response = [
            'succes'=>false,
            'data'=>'$tag',
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
        $tag = tag::Find($id);
        $input = $request->all();

        if (!$tag) {
            $response = [
                'success' => false,
                'data' => 'Validator Error. ',
                'message' => 'tag tidak ditemukan'
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
    $tag->nama=$input['nama'];
    $tag->save();
    $respons = [
        'success' => true,
        'data' => $tag,
        'message' => 'tagberhasil ditambahkan.'
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
        $tag= Kategori::find($id);

        if($artikel) {
        $respons = [
            'success' => false,
            'data' => 'Empety',
            'message' => 'tagtidak ditemukan'
        ];
        return response()->json($respons, 404);
        }
        $artikel->delete();
        $respons = [
            'success' => true,
            'data' => $artikel,
            'message' => 'tagberhasil dihapus.'
        ];
        return response()->json($respons, 200);
    }
}
