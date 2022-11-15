<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perencanaan;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class PerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perencanaan = Perencanaan::orderBy('target','ASC')->get();
        $response = [
            'data' => $perencanaan
        ];

        return response($response,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'rencana' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'target' => 'required'
        ]);

        // $data['syarat'] = $request->syarat;
        // $data['biaya'] = $request->biaya;

        if($data->fails()){
            return response()->json($data->errors(),422);
        }

        try{
            $data = Perencanaan::create($request->all());
            $response = [
                'message' => 'Perencanaan Dibuat',
                'data' => $data
            ];
            return response()->json($response,201);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Failed" . $e->errorInfo 
            ]);
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
        $perencanaan = Perencanaan::findorFail($id);
        $response = [
            'message' => 'Detail Perencanaan',
            'data' => $perencanaan
        ];
        return response()->json($response,200);
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
        $perencanaan = Perencanaan::findOrFail($id);

        $data = Validator::make($request->all(),[
            'rencana' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'target' => 'required'
        ]);

        if($data->fails()){
            return response()->json($data->errors(),422);
        }

        try{
            $perencanaan->update($request->all());
            $response = [
                'message' => 'Perencanaan Diubah',
                'data' => $perencanaan
            ];
            return response()->json($response,200);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Failed" . $e->errorInfo 
            ]);
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
        $perencanaan = Perencanaan::findOrFail($id);
        try{
            $perencanaan ->delete();
            $response = [
                'message' => 'Perencanaan Dihapus',
            ];
            return response()->json($response,200);
        }catch(QueryException $e){
            return response()->json([
                'message' => "Failed" . $e->errorInfo 
            ]);
        }
    }
}
