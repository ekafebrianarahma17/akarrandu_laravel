<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargasController extends Controller
{
    public function create(Request $request)
    {
        $warga = new Warga();
        $warga->user_id = Auth::user()->id;
        $warga->nama = $request->nama;
        $warga->nik = $request->nik;
        $warga->nohp = $request->nohp;
        $warga->kec = $request->kec;
        $warga->desa = $request->desa;
        $warga->rw = $request->rw;
        $warga->rt = $request->rt;
        $warga->alamat = $request->alamat;

        $warga->save();
        $warga->warga;
        return response()->json([
            'success' => true,
            'message' => 'posted',
            'warga' => $warga
        ]);
    }

    public function update(Request $request)
    {
        $warga = Warga::find($request->id);
        if (Auth::user()->id != $request->id) {
            return response()->json([
                'success' => false,
                'message' => 'unauthorized access'
            ]);
        }
        $warga->nama = $request->nama;
        $warga->nik = $request->nik;
        $warga->nohp = $request->nohp;
        $warga->kec = $request->kec;
        $warga->desa = $request->desa;
        $warga->rw = $request->rw;
        $warga->rt = $request->rt;
        $warga->alamat = $request->alamat;
        $warga->update();
        return response()->json([
            'success' => true,
            'message' => 'warga edited'
        ]);
    }

    public function delete(Request $request)
    {
        $warga = Warga::find($request->id);
        if (Auth::user()->id != $request->id) {
            return response()->json([
                'success' => false,
                'message' => 'unauthorized access'
            ]);
        }

        $warga->delete();
        return response()->json([
            'success' => true,
            'message' => 'warga delete'
        ]);
    }

    public function posts()
    {
        $user = auth()->id();
        $wargas = Warga::where('user_id', $user)->get();
        foreach ($wargas as $warga) {
            $warga->user;
        }

        return response()->json([
            'success' => true,
            'wargas' => $wargas
        ]);
    }
}
