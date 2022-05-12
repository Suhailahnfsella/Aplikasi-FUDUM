<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    //
    protected $fillable = ['','idtoko','namatoko','fototoko'
    ,'alamattoko','kecamatan','kabupaten','tahuntoko','','sosmed','whatsapp'
    ,'email'];
}
