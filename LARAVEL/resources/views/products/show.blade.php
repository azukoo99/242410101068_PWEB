@extends('layouts.app')

@section('content')
<div class="bg-white rounded-[18px] shadow-[0_4px_16px_rgba(0,0,0,0.1)] border border-slate-200/50 p-6 md:p-8 max-w-2xl mx-auto">
    <h1 class="text-[1.25rem] font-extrabold mb-6 pb-2 border-b-2 border-blue-100 bg-gradient-to-br from-slate-900 to-blue-600 bg-clip-text text-transparent inline-block">
        ℹ️ Detail Paket Diamond
    </h1>

    <div class="space-y-0 border-2 border-gray-100 rounded-xl overflow-hidden">
        <div class="flex flex-col sm:flex-row border-b border-gray-100 p-4 hover:bg-gray-50 transition-colors">
            <div class="sm:w-1/3 font-bold text-gray-500 text-sm mb-1 sm:mb-0">ID Paket</div>
            <div class="sm:w-2/3 text-gray-900 font-semibold">#{{ $product->id }}</div>
        </div>

        <div class="flex flex-col sm:flex-row border-b border-gray-100 p-4 hover:bg-gray-50 transition-colors">
            <div class="sm:w-1/3 font-bold text-gray-500 text-sm mb-1 sm:mb-0">Nama Paket</div>
            <div class="sm:w-2/3 text-gray-900 font-extrabold text-lg">{{ $product->nama_paket }}</div>
        </div>

        <div class="flex flex-col sm:flex-row border-b border-gray-100 p-4 hover:bg-gray-50 transition-colors">
            <div class="sm:w-1/3 font-bold text-gray-500 text-sm mb-1 sm:mb-0">Jumlah Diamond</div>
            <div class="sm:w-2/3 text-blue-600 font-bold">{{ number_format($product->jumlah_diamond) }} 💎</div>
        </div>

        <div class="flex flex-col sm:flex-row border-b border-gray-100 p-4 hover:bg-gray-50 transition-colors">
            <div class="sm:w-1/3 font-bold text-gray-500 text-sm mb-1 sm:mb-0">Harga</div>
            <div class="sm:w-2/3 text-emerald-600 font-extrabold text-xl">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
        </div>

        <div class="flex flex-col sm:flex-row border-b border-gray-100 p-4 hover:bg-gray-50 transition-colors items-center">
            <div class="sm:w-1/3 font-bold text-gray-500 text-sm mb-1 sm:mb-0">Status</div>
            <div class="sm:w-2/3">
                @if($product->status == 'tersedia')
                    <span class="inline-flex items-center bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold border border-emerald-200">
                        ✓ Tersedia
                    </span>
                @else
                    <span class="inline-flex items-center bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-bold border border-rose-200">
                        ✗ Habis
                    </span>
                @endif
            </div>
        </div>

        <div class="flex flex-col sm:flex-row border-b border-gray-100 p-4 hover:bg-gray-50 transition-colors">
            <div class="sm:w-1/3 font-bold text-gray-500 text-sm mb-2 sm:mb-0">Foto</div>
            <div class="sm:w-2/3">
                @if($product->foto)
                    <div class="w-48 h-48 rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                        <img src="{{ asset('storage/' . $product->foto) }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <span class="inline-block px-3 py-1.5 bg-gray-100 text-gray-500 text-xs font-medium rounded-md border border-gray-200 italic">Tidak ada foto</span>
                @endif
            </div>
        </div>

        <div class="flex flex-col sm:flex-row border-b border-gray-100 p-4 bg-gray-50/50">
            <div class="sm:w-1/3 font-bold text-gray-500 text-xs mb-1 sm:mb-0">Dibuat pada</div>
            <div class="sm:w-2/3 text-gray-500 text-xs font-medium">{{ $product->created_at->format('d M Y, H:i') }} WIB</div>
        </div>

        <div class="flex flex-col sm:flex-row p-4 bg-gray-50/50">
            <div class="sm:w-1/3 font-bold text-gray-500 text-xs mb-1 sm:mb-0">Terakhir update</div>
            <div class="sm:w-2/3 text-gray-500 text-xs font-medium">{{ $product->updated_at->format('d M Y, H:i') }} WIB</div>
        </div>
    </div>

    <div class="flex gap-3 mt-8 pt-4 border-t border-gray-100">
        <a href="{{ route('products.index') }}" class="bg-white border-2 border-gray-300 text-gray-700 font-bold py-2.5 px-6 rounded-lg hover:bg-gray-50 hover:-translate-y-1 transition-all duration-200">
            ⬅️ Kembali
        </a>
        <a href="{{ route('products.edit', $product) }}" class="bg-gradient-to-br from-amber-500 to-amber-600 text-white font-bold py-2.5 px-6 rounded-lg shadow-[0_4px_14px_rgba(245,158,11,0.35)] hover:-translate-y-1 hover:shadow-[0_6px_20px_rgba(245,158,11,0.5)] transition-all duration-200">
            ✏️ Edit Paket
        </a>
    </div>
</div>
@endsection
