<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = History::all();
    
        $datamenu = [
            'message' => 'succes',
            'status' => 202,
            'data' => $data
        ];

        return response()->json($datamenu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $date = Carbon::now()->format('d/m/Y');
        $data = [
            'iduser' => $request->input('iduser'),
            'idtoko' => $request->input('idtoko'),
            'namapenerima' => $request->input('namapenerima'),
            'alamatpenerima' => $request->input('alamatpenerima'),
            'kodeproduk' =>  $request->input('kodeproduk'),
            'jumlahpesanan' => $request->input('jumlahpesanan') ,
            'status' =>  'menunggu',
            'via' => $request->input('via'),
            'tgl' => $date,
            'bukti' => ""
        ];

        $menu = History::create($data);

        if ($menu) {
            return response()->json([
                'pesan' => 'Data sudah di simpan'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update($id)
    {
        //
        $data = [
            'status' =>  'Diproses',
        ];

        $menu =  History::where('nopesanan',$id)->update($data);
        if ($menu) {
            return response()->json([
                'pesan' => "Data sudah di ubah !"
            ]);
        }
    }

    public function update2($id)
    {
        //
        $data = [
            'status' =>  'Selesai',
        ];

        $menu =  History::where('nopesanan',$id)->update($data);
        if ($menu) {
            return response()->json([
                'pesan' => "Data sudah di ubah !"
            ]);
        }
    }

    public function update3(Request $request, $id)
    {
        //

        if($request->hasFile('gambar')){
            $gambar = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('upload',$gambar);
    
            $data = [
                'bukti' => url('upload/'.$gambar)
            ];
            
            $menu =  History::where('nopesanan',$id)->update($data);
            if ($menu) {
                return response()->json([
                    'pesan' => "Data sudah di ubah !"
                ]);
            }
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
        //
    }
}
