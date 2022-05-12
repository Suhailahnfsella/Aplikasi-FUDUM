<?php


namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = Toko::all();

        $dataUser = [
            'message' => 'succes',
            'status' => 202,
            'data' => $data
        ];

        return response()->json($dataUser);
    }

    public function index2($id)
    {
        $data = Toko::where('idtoko','=',$id)->get();
        foreach ($data as $image) {
          //  echo $image->path;
            return response()->json($image);
            }
    //     $data[0]->path;
    //    $object = (object) $data;

      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $this->validate($request,[
            'idtoko' => 'required | unique:tokos',
            'namatoko' => 'required | unique:tokos',
            'alamattoko' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'tahuntoko' => 'required | numeric',
            'sosmed' => 'required',
            'whatsapp' => 'required | numeric | unique:tokos',
            'email' => 'required | unique:tokos',

        ]);

        $gambar = $request->file('fototoko')->getClientOriginalName();
        $request->file('fototoko')->move('upload',$gambar);

        $data = [
            'idtoko' => $request->input('idtoko'),
            'namatoko' => $request->input('namatoko'),
            'fototoko' => url('upload/'.$gambar) ,
            'alamattoko' => $request->input('alamattoko'),
            'kecamatan' => $request->input('kecamatan'),
            'kabupaten' => $request->input('kabupaten'),
            'tahuntoko' => $request->input('tahuntoko'),
            'sosmed' => $request->input('sosmed'),
            'whatsapp' =>  $request->input('whatsapp'),
            'email' =>  $request->input('email')
        ];

        $toko = Toko::create($data);
        $dataToko = [
            'message' => 'succes',
            'status' => 202,
            'pesan' => 'daftar berhasil',
            'data' => $data
          ];
    
          return response()->json($dataToko);
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('menus')
       ->join('kategoris','kategoris.idkategori','=','menus.idkategori')
       ->select('menus.*','kategoris.kategori')
       ->where('idmenu','=',$id)
      
       ->get();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'idkategori' => 'required | numeric',
            'menu' => 'required',
            'harga' => 'required | numeric'

        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('upload',$gambar);
            $data = [
                'idkategori' => $request->input('idkategori'),
                'menu' =>  $request->input('menu'),
                'gambar' => url('upload/'.$gambar) ,
                'harga' =>  $request->input('harga')
            ];
        } else {
            $data = [
                'idkategori' => $request->input('idkategori'),
                'menu' =>  $request->input('menu'),
                'harga' =>  $request->input('harga')
            ];
        }

      
       
        
      $menu =  Menu::where('idmenu',$id)->update($data);
      if ($menu) {
          return response()->json([
              'pesan' => "Data sudah di ubah !"
          ]);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu =  Menu::where('idmenu',$id)->delete();

       if ($menu) {
        return response()->json([
            'pesan' => "Data sudah di hapus"
        ]);
       }
    }
}

