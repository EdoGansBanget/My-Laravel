<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Aktivitas;
use App\Models\Profile;
class TentangController extends Controller
{
    
    public function berita(Request $request) {
        $search = $request->input('search');
    
        $data = Berita::where(function($query) use ($search){
            $query->where('judul', 'LIKE', '%' . $search . '%');
        })->paginate(5);
    
        return view('info.berita', compact('data'));
    }
    public function profile(Request $request) {
        $search = $request->input('search');
    
        $data = Profile::where(function($query) use ($search){
            $query->where('nama', 'LIKE', '%' . $search . '%');
        })->paginate(5);
    
        return view('info.profile', compact('data'));
    }
    public function aktivitas(Request $request) {
        $search = $request->input('search');
    
        $data = Aktivitas::where(function($query) use ($search){
            $query->where('judul', 'LIKE', '%' . $search . '%');
        })->paginate(5);
    
        return view('info.aktivitas', compact('data'));
    }
    public function Biodata(Request $request) {
        
        return view('biodata');
    }

}