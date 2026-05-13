<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|min:3|unique:products,nama_paket',
            'jumlah_diamond' => 'required|integer|min:1',
            'harga' => 'required|integer|min:1000',
            'status' => 'required|in:tersedia,habis',
            'foto' => 'nullable|image|mimes:jpg,png|max:2048'
        ]);

        // JANGAN PAKAI $request->all()
        $data = [
            'nama_paket' => $request->nama_paket,
            'jumlah_diamond' => $request->jumlah_diamond,
            'harga' => $request->harga,
            'status' => $request->status,
            'foto' => $request->hasFile('foto') ? $request->file('foto')->store('products', 'public') : null
        ];

        Product::create($data);

        return redirect()->route('products.index')
                        ->with('success', 'Paket diamond berhasil ditambahkan!');
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_paket' => 'required|min:3|unique:products,nama_paket,' . $product->id,
            'jumlah_diamond' => 'required|integer|min:1',
            'harga' => 'required|integer|min:1000',
            'status' => 'required|in:tersedia,habis',
            'foto' => 'nullable|image|mimes:jpg,png|max:2048'
        ]);

        $data = [
            'nama_paket' => $request->nama_paket,
            'jumlah_diamond' => $request->jumlah_diamond,
            'harga' => $request->harga,
            'status' => $request->status
        ];

        if ($request->hasFile('foto')) {
            if ($product->foto) {
                Storage::disk('public')->delete($product->foto);
            }
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
                        ->with('success', 'Paket diamond berhasil diupdate!');
    }


    public function destroy(Product $product)
    {
        // Hapus file foto jika ada
        if ($product->foto) {
            Storage::disk('public')->delete($product->foto);
        }

        $product->delete();

        return redirect()->route('products.index')
                        ->with('success', 'Paket diamond berhasil dihapus!');
    }
}
