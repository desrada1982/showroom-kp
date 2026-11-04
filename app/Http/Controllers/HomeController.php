<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Motor::where('stok', '>', 0)->latest();

        if ($request->has('cari') && $request->cari != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama_motor', 'like', '%' . $request->cari . '%')
                    ->orWhere('merek', 'like', '%' . $request->cari . '%');
            });
        }

        $motors = $query->paginate(6);

        // Jika request datang dari JavaScript (AJAX/Fetch)
        if ($request->ajax()) {
            return view('katalog_list', compact('motors'))->render();
        }

        // Hitung data aktual dari database untuk transparansi informasi (R-17)
        $total_unit_ready = Motor::where('stok', '>', 0)->sum('stok');
        $total_model = Motor::where('stok', '>', 0)->count();

        // Jika request normal (baru pertama kali buka web)
        return view('welcome', compact('motors', 'total_unit_ready', 'total_model'));
    }
    public function show($id)
    {
        // Cari data motor berdasarkan ID, jika tidak ada akan error 404 (Not Found)
        $motor = Motor::findOrFail($id);

        return view('detail', compact('motor'));
    }
}
