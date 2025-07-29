<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\Mustahik;
use Illuminate\Http\Request;

class MustahikController extends Controller
{
public function index() {
    $data = Mustahik::paginate(5);
    $programs = Mustahik::select('program')->distinct()->get();
    $kecamatan = Mustahik::select('kecamatan')->distinct()->get();
    $kelurahan = Mustahik::select('kelurahan')->distinct()->get();

    return view('mustahik.index', compact('programs', 'kecamatan', 'kelurahan', 'data'));
}

public function dat() {
    $data = Mustahik::paginate(5);

    return view('mustahik.data', compact('data'));
}

public function data(Request $request) {
    $query = Mustahik::query();

    if ($request->program) {
        $query->where('program', $request->program);
    }
    if ($request->kecamatan) {
        $query->where('kecamatan', $request->kecamatan);
    }
    if ($request->kelurahan) {
        $query->where('kelurahan', $request->kelurahan);
    }
    if ($request->status) {
        $query->where('status', $request->status);
    }

    return response()->json($query->get());
}


}
