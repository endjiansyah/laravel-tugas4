<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produks = produk::query()
            ->get();
        return view("produk.list", ["produks" => $produks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = produk::all();
        return view("produk.create", compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file("foto");
        $filename = $file->hashName();
        $file->move("foto", $filename);
        $path = $request->getSchemeAndHttpHost() . "/foto/" . $filename;
        $isian = [
            "nama" => $request->input('nama'),
            "harga" => $request->input('harga'),
            "stock" => $request->input('stock'),
            "deskripsi" => $request->input('deskripsi'),
            "foto" => $path
        ];
        produk::query()->create($isian);
        return redirect()->back()->with(['success' => 'Data Tersimpan']);;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produk $produk)
    {
        $this->validate($request, [
            'nama' => 'Required',
            'stock' => 'Required',
            'harga' => 'Required',
            'foto' => 'file|image|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = $file->hashName();
            $file->move('foto', $filename);
            $path = $request->getSchemeAndHttpHost() . '/foto/' . $filename;
            $lokasifoto = str_replace($request->getSchemeAndHttpHost(), '', $produk->foto);
            $foto = public_path($lokasifoto);

            $produk->update([
                "nama" => $request->input('nama'),
                "harga" => $request->input('harga'),
                "stock" => $request->input('stock'),
                "deskripsi" => $request->input('deskripsi'),
                "foto" => $path
            ]);
            unlink($foto);
        } else {
            $produk->update([
                "nama" => $request->input('nama'),
                "harga" => $request->input('harga'),
                "stock" => $request->input('stock'),
                "deskripsi" => $request->input('deskripsi')
            ]);
        }

        return redirect()->back()->with(['success' => 'Data Tersimpan']);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(produk $produk, Request $request)
    {
        $lokasifoto = str_replace($request->getSchemeAndHttpHost(), '', $produk->foto);
        $foto = public_path($lokasifoto);
        $produk->delete();
        unlink($foto);
        return redirect()->back()->with(['hapus' => 'Data Tehapus']);;
    }
}
