<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Drink;
use App\Models\Foods;
use App\Models\Meja;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Resto extends Controller
{
    //

    function index(Request $request){
        $foods = Foods::all();
        $drinks = Drink::all();
        $meja = Meja::all();
        
        $kode = $request->session()->get('kode');
        $count = Cart::where('kode', $kode)->count();
        $cart = Cart::where('kode', $kode)->get();
        return view('resto.index', ['foods' => $foods, 'drinks' => $drinks, 'count' => $count, 'cart' => $cart, 'meja' => $meja]);
    }

    function add_customer(Request $request){
        $validated = $request->validate([
            'nama' => 'required',
        ]);

        $kode = 'cs-'.rand(0, 10000);
        $input = Customer::create([
            'kode' => $kode,
            'nama' => $request->nama
        ]);

        if ($input == true) {
            $request->session()->put('kode', $kode);
        } else {
            
        }
        return redirect('resto');
    }

    function hapus(Request $request){
        
        $request->session()->forget('kode');
        return redirect('resto');
    }

    function add_keranjang(Request $request){
        
        $data = [

            'kode' => $request->session()->get('kode'),
            'nama' => $request->nama,
            'gambar' => $request->gambar,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'qty' => 1,
            'total_harga' => $request->harga,
            'tgl' => date('Y-m-d'),
        ];
        
        $page = $request->page;
        $input = Cart::create($data);
        
        if($page == 'dishes'){
            $link = 'resto#'.$page;
            return redirect($link);
        }elseif($page == 'minuman'){
            $link = 'resto#'.$page;
            return redirect($link);
        }
    
    }

    function act_pesanan(Request $request){
            
        $input = Pesanan::create([
            'invoice' => rand(0, 100000),
            'kode' => $request->kode,
            'total_harga' => $request->total_harga,
            'tgl' => date('Y-m-d')
        ]);
        
        $request->session()->forget('kode');
        Alert::success('success', 'Pesanan anda berhasil dibuat');
        return redirect('resto');
    }

    function hapus_cart(Request $request, $id){

        $delete = Cart::where('id', $id)->delete();
        $kode = $request->session()->get('kode');
        $meja = Meja::all();
        $cart = Cart::where('kode', $kode)->get();
        $count = Cart::where('kode', $kode)->count();
        return view('resto.list_cart', ['cart' => $cart, 'count' => $count, 'meja' => $meja]);
        
    }
}
