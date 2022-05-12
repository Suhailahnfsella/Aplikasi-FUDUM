<?php


namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data = Menu::all();

       $data = DB::table('menus')
       ->join('kategoris','kategoris.idkategori','=','menus.idkategori')
       ->select('menus.*','kategoris.kategori')
       ->orderBy('menus.idmenu','asc')
       ->get();

       $datakategori = [
           'message' => 'succes',
           'status' => 202,
           'data' => $data
       ];

        return response()->json($datakategori);
    }

    public function index2($request)
    {
        $data = Menu::where('kodeproduk','=',$request)->get();
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
        //
        $this->validate($request,[
            'idkategori' => 'required | numeric',
            'idtoko' => 'required | numeric',
            'kategori' => 'required',
            'produk' => 'required',
            'kodeproduk' => 'required | unique:menus',
            'stok' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
            'harga' => 'required | numeric',
            'namatoko' => 'required',
            'fototoko' => 'required',
            'tahunusaha' => 'required | numeric',
            'alamattoko' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'sosmed' => 'required',
            'whatsapp' => 'required',
            'email' => 'required',
        ]);

        $gambar = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->move('upload',$gambar);

        $data = [
            'idkategori' => $request->input('idkategori'),
            'idtoko' => $request->input('idtoko'),
            'kategori' => $request->input('kategori'),
            'produk' => $request->input('produk'),
            'kodeproduk' => $request->input('kodeproduk'),
            'stok' => $request->input('stok'),
            'deskripsi' => $request->input('deskripsi'),
            'gambar' => url('upload/'.$gambar),
            'harga' => $request->input('harga'),
            'namatoko' => $request->input('namatoko'),
            'fototoko' => $request->input('fototoko'),
            'tahunusaha' => $request->input('tahunusaha'),
            'alamattoko' =>  $request->input('alamattoko'),
            'kecamatan' =>  $request->input('kecamatan'),
            'kabupaten' =>  $request->input('kabupaten'),
            'sosmed' =>  $request->input('sosmed'),
            'whatsapp' =>  $request->input('whatsapp'),
            'email' =>  $request->input('email')
        ];

        $menu = Menu::create($data);
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
    public function show(Request $request)
    {
        $search = $request->input('search');
        $data = DB::table('menus')
        ->join('kategoris','kategoris.idkategori','=','menus.idkategori')
        ->select('menus.*','kategoris.kategori')
        ->where('produk','LIKE','%'.$search.'%')

        ->get();

        return response()->json([
            'message'=>'data ada',
            'status'=>202,
            'data'=>$data
        ]);
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
        if($request->hasFile('gambar')){
            $gambar = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('upload',$gambar);
    
            $data = [
                'idkategori' => $request->input('idkategori'),
                'kategori' => $request->input('kategori'),
                'produk' => $request->input('produk'),
                'kodeproduk' => $request->input('kodeproduk'),
                'stok' => $request->input('stok'),
                'deskripsi' => $request->input('deskripsi'),
                'gambar' => url('upload/'.$gambar),
                'harga' => $request->input('harga'),
            ];
            
            $menu = Menu::where('idmenu',$id)->update($data);
            if($menu){
                return response()->json([
                    'message' => 'succes',
                    'status' => 202,
                    'pesan' => 'Data Berhasil diubah',
                    'data' => $data
                ]);
            }
        } else{
            $data = [
                'idkategori' => $request->input('idkategori'),
                'kategori' => $request->input('kategori'),
                'produk' => $request->input('produk'),
                'kodeproduk' => $request->input('kodeproduk'),
                'stok' => $request->input('stok'),
                'deskripsi' => $request->input('deskripsi'),
                'harga' => $request->input('harga'),
            ];
            
            $menu = Menu::where('idmenu',$id)->update($data);
            if($menu){
                return response()->json([
                    'message' => 'succes',
                    'status' => 202,
                    'pesan' => 'Data Berhasil diubah',
                    'data' => $data
                ]);
            }
        }
    } 

    public function update2(Request $request, $id)
    {
        $this->validate($request,[
            'kodeproduk' => 'required | unique:menus',
        ]);

        if($request->hasFile('gambar')){
            $gambar = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('upload',$gambar);
    
            $data = [
                'idkategori' => $request->input('idkategori'),
                'kategori' => $request->input('kategori'),
                'produk' => $request->input('produk'),
                'kodeproduk' => $request->input('kodeproduk'),
                'stok' => $request->input('stok'),
                'deskripsi' => $request->input('deskripsi'),
                'gambar' => url('upload/'.$gambar),
                'harga' => $request->input('harga'),
            ];
            
            $menu = Menu::where('idmenu',$id)->update($data);
            if($menu){
                return response()->json([
                    'message' => 'succes',
                    'status' => 202,
                    'pesan' => 'Data Berhasil diubah',
                    'data' => $data
                ]);
            }
        } else{
            $data = [
                'idkategori' => $request->input('idkategori'),
                'kategori' => $request->input('kategori'),
                'produk' => $request->input('produk'),
                'kodeproduk' => $request->input('kodeproduk'),
                'stok' => $request->input('stok'),
                'deskripsi' => $request->input('deskripsi'),
                'harga' => $request->input('harga'),
            ];
            
            $menu = Menu::where('idmenu',$id)->update($data);
            if($menu){
                return response()->json([
                    'message' => 'succes',
                    'status' => 202,
                    'pesan' => 'Data Berhasil diubah',
                    'data' => $data
                ]);
            }
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

