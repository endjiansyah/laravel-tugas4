@extends('template')

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <a href="{{ route('produk.create') }}" class="btn btn-secondary">Tambah Produk</a>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="card-info">
                        <td>Nama</td>
                        <td>Deskripsi</td>
                        <td>Harga</td>
                        <td>Stock</td>
                        <td>Foto</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                        <tr>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->deskripsi }}</td>
                            <td>{{ $produk->harga }}</td>
                            <td>{{ $produk->stock }}</td>
                            <td><img src="{{ $produk->foto }}" alt="{{ $produk->nama }}" width="100px"></td>
                            <td>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('produk.edit', $produk->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
