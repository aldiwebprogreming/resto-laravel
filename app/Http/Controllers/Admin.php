<?php

namespace App\Http\Controllers;

use App\Models\Admin as ModelsAdmin;
use App\Models\Drink;
use App\Models\Foods;
use App\Models\Meja;
use App\Models\Pegawai;
use App\Models\Snacks;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class Admin extends Controller
{
    
    function index(){
        return view('admin/index');
    }

    function makanan(){

        

        $kode = "kode-". rand(0, 10000);
        $foods = Foods::all();
        return view('admin.makanan',['kode' => $kode, 'foods' => $foods]);
    }

    function act_makanan(Request $request){
        $valiadated = $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required',
        ]);
            $image = $request->file('gambar');
            $image->storeAs('public/img_makanan', $image->hashName());
        $add = Foods::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'harga' => $request->harga,
            'gambar' => $image->hashName(),
            'keterangan' => $request->keterangan
        ]);
        Alert::success('Success', 'Data berhasil ditambah');
        return redirect('makanan');
    }

    function hapus_food(Request $request){
            $id = $request->id;
            $delete = Foods::where('id', $id)->delete();
            Alert::success('Success', 'Data berhasil dihapus');
            return redirect('makanan');
    }

    function act_edit_food(Request $request, $id){  

        $gambar = $request->gambar;

        if($gambar == null){
            
            $update = Foods::where('id', $id)->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
            ]);
        }else{

            $image = $request->file('gambar');
            $image->storeAs('public/img_makanan', $image->hashName());

            $update = Foods::where('id', $id)->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'gambar' => $image->hashName(),
            ]);

        }
        
       
        Alert::success('Success', 'Data berhasil diubah');
        return redirect('makanan');
        
    }


    function minuman(){
        $kode = "kode-".rand(0, 100000);
        $drinks = Drink::all();
        return view('admin.minuman', ['kode' => $kode, 'drinks' => $drinks]);
    }

    function act_minuman(Request $request){
        $valiadated = $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required',
        ]);

        $image = $request->file('gambar');
        $image->storeAs('public/img_minuman', $image->hashName());

        $input = Drink::create([
            'kode' => $request->kode, 
            'nama' => $request->nama,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'gambar' => $image->hashName(),
        ]);
        Alert::success('Success', 'Data berhasil ditambah');
        return redirect('minuman');
    }

    function hapus_drink(Request $request){
        
        $id = $request->id;
        $delete = Drink::where('id', $id)->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('minuman');
    }

    function act_edit_drink(Request $request, $id){

        $gambar = $request->gambar;
        if($gambar == null){
            $update = Drink::where('id', $id)->update([
                'kode' => $request->kode, 
                'nama' => $request->nama,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
            ]);
        }else{
          
            $image = $request->file('gambar');
            $image->storeAs('public/img_minuman', $image->hashName());

            $update = Drink::where('id', $id)->update([
                'kode' => $request->kode, 
                'nama' => $request->nama,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'gambar' => $image->hashName()
            ]);
        }
        
      
        Alert::success('Success', 'Data berhasil diubah');
        return redirect('minuman');

    }

    function cemilan(){
        
        $kode = 'kode-'. rand(0, 100000);
        $snacks = Snacks::all();
        return view('admin.cemilan',['kode' => $kode, 'snacks' => $snacks]);
    }

    function act_cemilan(Request $request){

        $valiadated = $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required',
        ]);

        $input = Snacks::create([
            'kode' => $request->kode, 
            'nama' => $request->nama,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'gambar' => $request->gambar
        ]);
        Alert::success('Success', 'Data berhasil ditambah');
        return redirect('cemilan');
    }


    function hapus_snacks(Request $request){
        $id = $request->id;
        $delete = Snacks::where('id', $id)->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('cemilan');
    }

    function act_edit_snacks(Request $request, $id){

        $update = Snacks::where('id', $id)->update([
            'kode' => $request->kode, 
            'nama' => $request->nama,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'gambar' => $request->gambar
        ]);
        Alert::success('Success', 'Data berhasil diubah');
        return redirect('cemilan');
    }

    function pegawai (){
        
        $pegawai = Pegawai::all();
        $kode = 'kode-'.rand(0, 100000);
        return view('admin.pegawai',['kode' => $kode, 'pegawai' => $pegawai]);
    }

    function act_pegawai(Request $request){
        
        $valiadated = $request->validate([
            'nama' => 'required',
            'nowa' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
        ]);

        $input = Pegawai::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'nowa' => $request->nowa,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
        ]);
        Alert::success('Success', 'Data berhasil ditambah');
        return redirect('pegawai');
    }

    function hapus_pegawai(Request $request){
        $id = $request->id;
        $delete = Pegawai::where('id', $id)->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect('pegawai');
    }

    function act_edit_pegawai(Request $request, $id){

        $valiadated = $request->validate([
            'nama' => 'required',
            'nowa' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
        ]);
        
        $update = Pegawai::where('id', $id)->update([
            'nama' => $request->nama,
            'nowa' => $request->nowa,
            'jk' => $request->jk,
            'alamat' => $request->alamat
        ]);
        Alert::success('Success', 'Data berhasil diedit');
        return redirect('pegawai');
    }   

    function data_admin(){
        $kode = 'kode-'.rand(0, 100000);
        $admin = ModelsAdmin::all();
        return view('admin.admin', ['kode' => $kode, 'admin' => $admin]);
        
    }

    function add_admin(Request $request){
        $valiadated = $request->validate([
            'username' => 'required',
            'pass' => 'required'
        ]);
        
        $input = [
            'kode' => $request->kode,
            'username' => $request->username,
            'password' => Hash::make($request->pass),
            'role' => $request->role,
        ];
        
        ModelsAdmin::create($input);
        Alert::success('Success', 'Data berhasil ditambah');
        return redirect('admin');
    }

function hapus_admin(Request $request){
    
    $id = $request->id;
    $delete = ModelsAdmin::where('id', $id)->delete();
    Alert::success('Success', 'Data berhasil dihapus');
    return redirect('admin');
}


function meja(){
    $kode = 'kode-'.rand(0, 100000);
    $limit = Meja::latest()->first();
    $meja = Meja::all();
    return view('admin.meja', ['kode' => $kode, 'meja' => $meja, 'limit' => $limit]);
}

function act_meja(Request $request){
    
    $input = [
        'kode' => $request->kode,
        'no_meja' => $request->no_meja
    ];

    Meja::create($input);
    Alert::success('success', "Data berhasil ditambah");
    return redirect('meja');
}
            

}
