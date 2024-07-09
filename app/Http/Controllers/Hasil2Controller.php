<?php

namespace App\Http\Controllers;

use App\Models\Hasil2;
use Illuminate\Http\Request;

class Hasil2Controller extends Controller
{
    /**
     * Menyimpan hasil prediksi ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'testid' => 'required|integer',
            'report' => 'required|string',
        ]);

        $hasil2 = Hasil2::create([
            'testid' => $request->testid,
            'report' => $request->report,
        ]);

        return response()->json($hasil2, 201);
    }
}
