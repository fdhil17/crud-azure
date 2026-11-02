<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric|min:0',
            'deskripsi_produk' => 'required|string',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_produk')) {

            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0777, true);
            }

            $imageName = time() . '.' . $request->foto_produk->extension();
            $request->foto_produk->move(public_path('images'), $imageName);
            $data['foto_produk'] = $imageName;
        }

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_satuan' => 'required|numeric|min:0',
            'deskripsi_produk' => 'required|string',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_produk')) {

            if ($product->foto_produk && file_exists(public_path('images/' . $product->foto_produk))) {
                unlink(public_path('images/' . $product->foto_produk));
            }

            $imageName = time() . '.' . $request->foto_produk->extension();
            $request->foto_produk->move(public_path('images'), $imageName);
            $data['foto_produk'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->foto_produk && file_exists(public_path('images/' . $product->foto_produk))) {
            unlink(public_path('images/' . $product->foto_produk));
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
