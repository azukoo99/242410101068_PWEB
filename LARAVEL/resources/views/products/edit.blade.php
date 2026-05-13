@extends('layouts.app')

@section('content')
<div class="bg-white rounded-[18px] shadow-[0_4px_16px_rgba(0,0,0,0.1)] border border-slate-200/50 p-6 md:p-8 max-w-2xl mx-auto">
    <h1 class="text-[1.25rem] font-extrabold mb-6 pb-2 border-b-2 border-blue-100 bg-gradient-to-br from-slate-900 to-blue-600 bg-clip-text text-transparent inline-block">
        ✏️ Edit Paket Diamond
    </h1>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
        @csrf
        @method('PUT')

        <div class="p-5 border-2 border-gray-200 rounded-xl focus-within:border-blue-500 transition-colors">
            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Paket <span class="text-red-500">*</span></label>
            <input type="text" name="nama_paket" value="{{ old('nama_paket', $product->nama_paket) }}"
                   class="w-full border-[1.5px] border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all @error('nama_paket') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror">
            @error('nama_paket')
                <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div class="p-5 border-2 border-gray-200 rounded-xl focus-within:border-blue-500 transition-colors">
            <label class="block text-sm font-bold text-gray-700 mb-2">Jumlah Diamond <span class="text-red-500">*</span></label>
            <input type="number" name="jumlah_diamond" value="{{ old('jumlah_diamond', $product->jumlah_diamond) }}"
                   class="w-full border-[1.5px] border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all @error('jumlah_diamond') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror">
            @error('jumlah_diamond')
                <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div class="p-5 border-2 border-gray-200 rounded-xl focus-within:border-blue-500 transition-colors">
            <label class="block text-sm font-bold text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
            <input type="number" name="harga" value="{{ old('harga', $product->harga) }}"
                   class="w-full border-[1.5px] border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all @error('harga') border-red-500 focus:border-red-500 focus:ring-red-500/10 @enderror">
            @error('harga')
                <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div class="p-5 border-2 border-gray-200 rounded-xl focus-within:border-blue-500 transition-colors">
            <label class="block text-sm font-bold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
            <select name="status" class="w-full border-[1.5px] border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all bg-white">
                <option value="tersedia" {{ old('status', $product->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="habis" {{ old('status', $product->status) == 'habis' ? 'selected' : '' }}>Habis</option>
            </select>
        </div>

        <div class="p-5 border-2 border-gray-200 rounded-xl focus-within:border-blue-500 transition-colors">
            <label class="block text-sm font-bold text-gray-700 mb-2">Foto Saat Ini</label>
            @if($product->foto)
                <div class="w-24 h-24 rounded-lg border border-gray-200 overflow-hidden shadow-sm mb-3">
                    <img src="{{ asset('storage/' . $product->foto) }}" class="w-full h-full object-cover">
                </div>
                <p class="text-gray-500 text-xs font-medium">Kosongkan input foto di bawah jika tidak ingin mengganti</p>
            @else
                <p class="text-gray-500 text-sm italic">Tidak ada foto</p>
            @endif
        </div>

        <div class="p-5 border-2 border-gray-200 rounded-xl focus-within:border-blue-500 transition-colors">
            <label class="block text-sm font-bold text-gray-700 mb-2">Ganti Foto (Opsional)</label>
            <input type="file" name="foto" accept="image/jpeg,image/png"
                   class="w-full border-[1.5px] border-gray-300 rounded-lg px-4 py-2.5 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all focus:outline-none focus:border-blue-600 @error('foto') border-red-500 focus:border-red-500 @enderror">
            <p class="text-gray-500 text-xs font-medium mt-2">💡 Format: JPG/PNG, maksimal 2MB</p>
            @error('foto')
                <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 mt-4 pt-4 border-t border-gray-100">
            <button type="submit" class="bg-gradient-to-br from-amber-500 to-amber-600 text-white font-bold py-2.5 px-6 rounded-lg shadow-[0_4px_14px_rgba(245,158,11,0.35)] hover:-translate-y-1 hover:shadow-[0_6px_20px_rgba(245,158,11,0.5)] transition-all duration-200">
                🔄 Update
            </button>
            <a href="{{ route('products.index') }}" class="bg-white border-2 border-gray-300 text-gray-700 font-bold py-2.5 px-6 rounded-lg hover:bg-gray-50 hover:-translate-y-1 transition-all duration-200">
                ✖ Batal
            </a>
        </div>
    </form>
</div>
@endsection
