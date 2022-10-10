<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_pertanyaan;
use Illuminate\Support\Facades\DB;

class Pertanyaan extends Controller
{
    public function pertanyaan(Request $request){
        $data = tbl_pertanyaan::create([
            'pertanyaan' => $request -> pertanyaan,
            'jawaban' => 'null'
        ]);
        $res['message'] = "Terimakasih sudah bertanya, tunggu balasan dari admin ya !";
        $res['question'] = $data;
        return response($res);
    }

    public function jawaban(Request $request){
        $ket = DB::table('tbl_pertanyaan')->where('id', $request->id)->update([
            'jawaban' => $request -> jawaban,
            ]);
        $res['message'] = "Sukses !";
        $res['value'] = $ket;
        return response($res);
    }
} 
