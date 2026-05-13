@extends('layouts.app')

@section('content')
<div class="bg-white rounded-[18px] shadow-[0_4px_16px_rgba(0,0,0,0.1)] border border-slate-200/50 p-6 md:p-8">
    <div class="flex flex-col md:flex-row justify-between md:items-center mb-6 gap-4">
        <div>
            <h1 class="text-[1.25rem] font-extrabold mb-2 pb-2 border-b-2 border-blue-100 bg-gradient-to-br from-slate-900 to-blue-600 bg-clip-text text-transparent inline-block">
                💎 Kelola Stok Diamond
            </h1>
            <p class="text-sm text-slate-500 mt-1">Tambah, edit, hapus, dan kelola stok paket diamond Anda.</p>
        </div>
        <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center bg-gradient-to-br from-blue-600 to-blue-700 text-white font-bold text-sm py-2.5 px-5 rounded-[8px] shadow-[0_4px_14px_rgba(37,99,235,0.35)] hover:-translate-y-1 hover:shadow-[0_6px_20px_rgba(37,99,235,0.5)] transition-all duration-200">
            + Tambah Paket
        </a>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-100">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-blue-50 text-blue-800">
                    <th class="py-3.5 px-5 font-bold text-sm border-b border-blue-100">ID</th>
                    <th class="py-3.5 px-5 font-bold text-sm border-b border-blue-100">Nama Paket</th>
                    <th class="py-3.5 px-5 font-bold text-sm border-b border-blue-100">Jumlah Diamond</th>
                    <th class="py-3.5 px-5 font-bold text-sm border-b border-blue-100">Harga</th>
                    <th class="py-3.5 px-5 font-bold text-sm border-b border-blue-100">Status</th>
                    <th class="py-3.5 px-5 font-bold text-sm border-b border-blue-100">Foto</th>
                    <th class="py-3.5 px-5 font-bold text-sm border-b border-blue-100 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($products as $product)
                <tr class="hover:bg-blue-50/50 transition-colors group">
                    <td class="py-3 px-5 border-b border-gray-100 text-gray-500">{{ $product->id }}</td>
                    <td class="py-3 px-5 border-b border-gray-100 font-bold text-gray-800">{{ $product->nama_paket }}</td>
                    <td class="py-3 px-5 border-b border-gray-100 font-semibold text-blue-600">{{ number_format($product->jumlah_diamond) }} 💎</td>
                    <td class="py-3 px-5 border-b border-gray-100 font-bold text-emerald-600">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td class="py-3 px-5 border-b border-gray-100">
                        @if($product->status == 'tersedia')
                            <span class="inline-flex items-center bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-full text-xs font-bold border border-emerald-200">
                                ✓ Tersedia
                            </span>
                        @else
                            <span class="inline-flex items-center bg-rose-100 text-rose-700 px-2.5 py-1 rounded-full text-xs font-bold border border-rose-200">
                                ✗ Habis
                            </span>
                        @endif
                    </td>
                    <td class="py-3 px-5 border-b border-gray-100">
                        @if($product->foto)
                            <div class="w-12 h-12 rounded-lg border border-gray-200 overflow-hidden shadow-sm">
                                <img src="{{ asset('storage/' . $product->foto) }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <span class="inline-block px-2 py-1 bg-gray-100 text-gray-400 text-xs rounded-md border border-gray-200">Tidak ada</span>
                        @endif
                    </td>
                    <td class="py-3 px-5 border-b border-gray-100 text-center">
                        <div class="flex items-center justify-center gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('products.show', $product) }}" class="bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold px-3 py-1.5 rounded-md text-xs transition-colors">
                                Detail
                            </a>
                            <a href="{{ route('products.edit', $product) }}" class="bg-amber-100 hover:bg-amber-200 text-amber-700 font-semibold px-3 py-1.5 rounded-md text-xs transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus paket {{ $product->nama_paket }}?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-rose-100 hover:bg-rose-200 text-rose-700 font-semibold px-3 py-1.5 rounded-md text-xs transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <span class="text-4xl mb-3">💎</span>
                            <h3 class="text-lg font-bold text-gray-700 mb-1">Belum Ada Paket Diamond</h3>
                            <p class="text-sm">Tambahkan paket diamond pertama melalui tombol di atas.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection
