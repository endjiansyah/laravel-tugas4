@extends('template')

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data"
                class="card card-body">
                @csrf
                @method('put')
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" value="{{ $produk->nama }}" id="nama" class="form-control mb-3">

                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control mb-3">{{ $produk->deskripsi }}</textarea>
                {{-- <input type="text" name="deskripsi" value="{{ $produk->deskripsi }}" id="deskripsi" class="form-control mb-3"> --}}

                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" value="{{ $produk->harga }}" id="harga" class="form-control mb-3">

                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" value="{{ $produk->stock }}" id="stock" class="form-control mb-3">

                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control mb-3">

                <input type="submit" value="Save" class="btn btn-success mt-3">
            </form>
        </div>
    </div>
@endsection
