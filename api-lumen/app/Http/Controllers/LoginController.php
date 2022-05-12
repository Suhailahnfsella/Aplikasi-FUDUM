<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
  public function index()
  {
   $data = User::where('level','=','pelanggan')->get();

   $dataUser = [
    'message' => 'succes',
    'status' => 202,
    'data' => $data
  ];

   return response()->json($dataUser);
  }

  public function index2()
  {
   $data = User::where('level','=','admin')->get();

   $dataUser = [
    'message' => 'succes',
    'status' => 202,
    'data' => $data
  ];

   return response()->json($dataUser);
  }

  public function register(Request $request){
      $this->validate($request,[
        'idtoko' => '!=0 | numeric | unique:users',
        'username' => 'required | unique:users',
        'email' => 'required | email | unique:users',
        'telp' => 'required | numeric | unique:users',
        'namapanjang' => 'required | regex:/^[a-zA-Z\s]+$/',
        'password' => ['required', 
        'min:8', 
        'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/']
      ]);

      $level = "pelanggan";

      if($request->hasFile('fotoprofil')){
        $gambar = $request->file('fotoprofil')->getClientOriginalName();
        $request->file('fotoprofil')->move('upload',$gambar);
        $data = [
          'idtoko' =>  '0',
          'username' => $request->input('username'),
          'email' => $request->input('email'),
          'telp' => $request->input('telp'),
          'namapanjang' => $request->input('namapanjang'),
          'fotoprofil' => url('upload/',$gambar),
          'password' => $request->input('password') ,
          'level' => $level,
          'api_token' => '123456',
          'status' => '0',
        ];
      }else{
        $data = [
          'idtoko' =>  '0',
          'username' => $request->input('username'),
          'email' => $request->input('email'),
          'telp' => $request->input('telp'),
          'namapanjang' => $request->input('namapanjang'),
          'fotoprofil' => 'http://192.168.0.157:8000/upload/ff.png',
          'password' => $request->input('password') ,
          'level' => $level,
          'api_token' => '123456',
          'status' => '0',
        ];
      }
     

      User::create($data);
      $dataUser = [
        'message' => 'succes',
        'status' => 202,
        'pesan' => 'daftar berhasil',
        'data' => $data
      ];

      return response()->json($dataUser);
    }

    public function registeradm(Request $request){
      $this->validate($request,[
        'idtoko' => '!=0 | numeric | unique:users',
        'username' => 'required | unique:users',
        'email' => 'required | email | unique:users',
        'telp' => 'required | numeric | unique:users',
        'namapanjang' => 'required | regex:/^[a-zA-Z\s]+$/',
        'password' => ['required', 
        'min:8', 
        'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/']
      ]);

      $level = "admin";

      if($request->hasFile('fotoprofil')){
        $gambar = $request->file('fotoprofil')->getClientOriginalName();
        $request->file('fotoprofil')->move('upload',$gambar);
        $data = [
          'idtoko' =>  '0',
          'username' => $request->input('username'),
          'email' => $request->input('email'),
          'telp' => $request->input('telp'),
          'namapanjang' => $request->input('namapanjang'),
          'fotoprofil' => url('upload/',$gambar),
          'password' => $request->input('password') ,
          'level' => $level,
          'api_token' => '123456',
          'status' => '0',
        ];
      }else{
        $data = [
          'idtoko' =>  '0',
          'username' => $request->input('username'),
          'email' => $request->input('email'),
          'telp' => $request->input('telp'),
          'namapanjang' => $request->input('namapanjang'),
          'fotoprofil' => 'http://192.168.0.157:8000/upload/ff.png',
          'password' => $request->input('password') ,
          'level' => $level,
          'api_token' => '123456',
          'status' => '0',
        ];
      }

      User::create($data);
      $dataUser = [
        'message' => 'succes',
        'status' => 202,
        'pesan' => 'daftar berhasil',
        'data' => $data
      ];

      return response()->json($dataUser);
    }

    public function login(Request $request){
      $username = $request->input('username');
      $password = $request->input('password');

      $user = User::where(['username' => $username, 'password' => $password])->first();

      $level = "pelanggan";

      if (isset($user)) {
          if ($password && $username) {
            if ($user->level === $level) {
                // $user->update([
                //     'api_token' => $token
                // ]);
                return response()->json([
                  'message' => 'succes',
                  'status' => 202,
                  'pesan' => 'login berhasil',
                  'data' => $user
                ]);
            } else{
              return response()->json([
               'message' => 'succes',
               'status' => 202,
               'pesan' => 'login gagal',
               'data' => ''
               ]);
            }  
          }else{
           return response()->json([
            'message' => 'succes',
            'status' => 202,
            'pesan' => 'login gagal',
            'data' => ''
            ]);
         }
        }else{
        return response()->json([
          'message' => 'succes',
               'status' => 202,
               'pesan' => 'login gagal',
               'data' => ''
       ]);
    }
    $data = DB::table('users')
       ->join('menus','menus.idtoko','=','users.idtoko')
       ->select('users.*','menus.produk')
       ->where('id','=',$user->id)
      
       ->get();
  }

  public function loginadm(Request $request){
    $username = $request->input('username');
    $password = $request->input('password');

    $user = User::where(['username' => $username, 'password' => $password])->first();

    $level = "admin";

    if (isset($user)) {
        if ($password && $username) {
          if ($user->level === $level) {
              // $user->update([
              //     'api_token' => $token
              // ]);
              return response()->json([
                'message' => 'succes',
                'status' => 202,
                'pesan' => 'login berhasil',
                'data' => $user
              ]);
          } else{
            return response()->json([
             'message' => 'succes',
             'status' => 202,
             'pesan' => 'login gagal',
             'data' => ''
             ]);
          }  
        }else{
         return response()->json([
          'message' => 'succes',
          'status' => 202,
          'pesan' => 'login gagal',
          'data' => ''
          ]);
       }
      }else{
      return response()->json([
        'message' => 'succes',
             'status' => 202,
             'pesan' => 'login gagal',
             'data' => ''
     ]);
  }
  $data = DB::table('users')
     ->join('menus','menus.idtoko','=','users.idtoko')
     ->select('users.*','menus.produk')
     ->where('id','=',$user->id)
    
     ->get();
}

  public function loginforgetpass(Request $request)
    {
      $email = $request->input('email');
      $user = User::where(['email' => $email])->first();

      if (isset($user)) {
          if (($email)) {

            return response()->json([
              'message' => 'succes',
              'status' => 202,
              'pesan' => 'LoginBerhaasil',
              'data' => $user
              
            ]);
         }else{
           return response()->json([
            'message' => 'succes',
            'status' => 202,
            'pesan' => 'Gagal',
            'data' => ''
            ]);
         }
      }else{
        return response()->json([
          'message' => 'succes',
          'status' => 202,
          'pesan' => 'Gagal',
          'data' => ''
       ]);
      }

    }

    public function update(Request $request, $id){
      $this->validate($request,[
        'password' => ['required', 
        'min:8', 
        'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/']
      ]);

      $data = [
        'password' => $request->input('password')
    ];

    $user =  User::where('id',$id)->update($data);
      if ($user) {
          return response()->json([
            'message' => 'succes',
            'status' => 202,
            'pesan' => 'Data Berhasil diubah',
            'data' => $data
          ]);
         }
    }

    public function update2(Request $request, $id){
      if($request->hasFile('fotoprofil')){
        if($request->input('username') != null){
          if($request->input('namapanjang') != null){
            if($request->input('password') != null){
              $gambar = $request->file('fotoprofil')->getClientOriginalName();
              $request->file('fotoprofil')->move('upload',$gambar);
              $data = [
              'username' => $request->input('username'),
              'namapanjang' => $request->input('namapanjang'),
              'password' => $request->input('password') ,
              'fotoprofil' => url('upload/',$gambar),];
            }else{
              $gambar = $request->file('fotoprofil')->getClientOriginalName();
              $request->file('fotoprofil')->move('upload',$gambar);
              $data = [
              'username' => $request->input('username'),
              'namapanjang' => $request->input('namapanjang'),
              'fotoprofil' => url('upload/',$gambar),];
            }
          } else{
            if($request->input('password') != null){
              $gambar = $request->file('fotoprofil')->getClientOriginalName();
              $request->file('fotoprofil')->move('upload',$gambar);
              $data = [
              'username' => $request->input('username'),
              'password' => $request->input('password') ,
              'fotoprofil' => url('upload/',$gambar),];
            }else{
              $gambar = $request->file('fotoprofil')->getClientOriginalName();
              $request->file('fotoprofil')->move('upload',$gambar);
              $data = [
              'username' => $request->input('username'),
              'fotoprofil' => url('upload/',$gambar),];
            }
          }
        } else{
          if($request->input('namapanjang') != null){
            if($request->input('password') != null){
              $gambar = $request->file('fotoprofil')->getClientOriginalName();
              $request->file('fotoprofil')->move('upload',$gambar);
              $data = [
              'namapanjang' => $request->input('namapanjang'),
              'password' => $request->input('password') ,
              'fotoprofil' => url('upload/',$gambar),];
            }else{
              $gambar = $request->file('fotoprofil')->getClientOriginalName();
              $request->file('fotoprofil')->move('upload',$gambar);
              $data = [
              'namapanjang' => $request->input('namapanjang'),
              'fotoprofil' => url('upload/',$gambar),];
            }
          } else{
            if($request->input('password') != null){
              $gambar = $request->file('fotoprofil')->getClientOriginalName();
              $request->file('fotoprofil')->move('upload',$gambar);
              $data = [
              'password' => $request->input('password') ,
              'fotoprofil' => url('upload/',$gambar),];
            }else{
              $gambar = $request->file('fotoprofil')->getClientOriginalName();
              $request->file('fotoprofil')->move('upload',$gambar);
              $data = [
              'fotoprofil' => url('upload/',$gambar),];
            }
          }
        }
      }else{
        if($request->input('username') != null){
          if($request->input('namapanjang') != null){
            if($request->input('password') != null){
              $data = [
                'username' => $request->input('username'),
                'namapanjang' => $request->input('namapanjang'),
                'password' => $request->input('password')
                ];
            }else{
              $data = [
                'username' => $request->input('username'),
                'namapanjang' => $request->input('namapanjang'),
                ];
            }
          } else{
            if($request->input('password') != null){
              $data = [
                'username' => $request->input('username'),
                'password' => $request->input('password')
                ];
            }else{
              $data = [
                'username' => $request->input('username'),
                ];
            }
          }
        } else{
          if($request->input('namapanjang') != null){
            if($request->input('password') != null){
              $data = [
                'namapanjang' => $request->input('namapanjang'),
                'password' => $request->input('password')
                ];
            }else{
              $data = [
                'namapanjang' => $request->input('namapanjang'),
                ];
            }
          } else{
            if($request->input('password') != null){
              $data = [
                'password' => $request->input('password')
                ];
            }else{
              $data = [];
            }
          }
        }
      }

    $user =  User::where('id',$id)->update($data);
      if ($user) {
          return response()->json([
            'message' => 'succes',
            'status' => 202,
            'pesan' => 'Data Berhasil diubah',
            'data' => $data
          ]);
        }
    }

    public function update3(Request $request, $id){
      $this->validate($request,[
        'status' => 'required'
      ]);

      $data = [
        'status' => $request->input('status')
      ];

      $user =  User::where('id',$id)->update($data);
        if ($user) {
            return response()->json([
              'message' => 'succes',
              'status' => 202,
              'pesan' => 'Data Berhasil diubah',
              'data' => $data
            ]);
          }
      }
}
