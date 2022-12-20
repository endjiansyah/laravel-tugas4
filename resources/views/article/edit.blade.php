@extends('template')

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <a href="{{ route('article.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data"
                class="card card-body">
                @csrf
                @method('put')
                <label for="title" class="form-label">title</label>
                <input type="text" name="title" value="{{ $article->title }}" id="title" class="form-control mb-3">

                <label for="description" class="form-label">description</label>
                <textarea name="description" id="description" class="form-control mb-3">{{ $article->description }}</textarea>

                <label for="gambar" class="form-label">gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control mb-3">

                <input type="submit" value="Save" class="btn btn-success mt-3">
            </form>
        </div>
    </div>
@endsection
