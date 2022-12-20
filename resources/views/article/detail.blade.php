@extends('template')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between my-auto">
                <h5>{{ $article->title }}</h5>
                <p class="font-bold">
                    Post: {{ $article->updated_at }}
                </p>
            </div>
        </div>
        <div class="card-body row">
            <div class="col-lg-7 pt-3">
                <p>
                    {{ $article->description }}
                </p>
            </div>
            <div class="col-lg-5">
                <img src="{{ $article->gambar }}" alt="{{ $article->title }}" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
