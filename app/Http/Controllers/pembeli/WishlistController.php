<?php

namespace App\Http\Controllers\pembeli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    //
    public function index()
    {
        $data = DB::table('wishlist')
            ->join('produk', 'produk.idproduk', '=', 'wishlist.produk_idproduk')
            ->join('gambar_produk', 'produk.idproduk', '=', 'gambar_produk.produk_idproduk')
            ->where('wishlist.users_id', Auth::user()->id)
            ->select('gambar_produk.idgambar_produk', 'produk.nama', 'produk.idproduk', 'produk.harga', 'produk.toko_users_id')
            ->groupBy('produk.idproduk')
            ->paginate(10);
        return view('pembeli.wishlist', compact('data'));
        return $data;
    }
    public function store($id)
    {
        try {
            DB::table('wishlist')->updateOrInsert(
                [
                    'users_id' => Auth::user()->id,
                    'produk_idproduk' => $id
                ]
            );
            return redirect()->back()->with('sukses', 'Berhasil tambah ke wishlist');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            DB::table('wishlist')->where('users_id', Auth::user()->id)->where('produk_idproduk', $id)->delete();
            return redirect()->back()->with('sukses', 'Berhasil hapus wishlist');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
    public function addToCart($id)
    {
        try {
            DB::table('keranjang')->updateOrInsert(
                [
                    'users_id' => Auth::user()->id,
                    'produk_idproduk' => $id
                ],
                ['jumlah' => 1]
            );
            return redirect()->back()->with('sukses', 'Berhasil tambah ke keranjang');
        } catch (\Exception $e) {
            return redirect()->back()->with('gagal', $e->getMessage());
        }
    }
}
