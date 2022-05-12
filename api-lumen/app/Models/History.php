<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
    protected $table = 'historys';
    protected $fillable = ['iduser', 'idtoko', 'namapenerima', 'alamatpenerima', 'kodeproduk',
    'jumlahpesanan', 'status', 'via', 'tgl', 'bukti'];
}
