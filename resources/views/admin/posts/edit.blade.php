@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Modifica: {{$post->title}}</h2>

        <form action="{{route("posts.update", $post->id)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control @error("title") is-invalid @enderror" id="title" name="title" placeholder="Inserisci il titolo" value="{{old("title", $post->title)}}">
                @error("title")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Descrizione</label>
                <textarea rows="5" type="text" class="form-control @error("content") is-invalid @enderror" id="content" name="content" placeholder="Descrivi il post">{{old("content", $post->content)}}}</textarea>
                @error("content")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Seleziona una categoria</label>
                <select class="custom-select @error("category_id") is-invalid @enderror" name="category_id" id="category">
                    <option></option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{old("category_id", $post->category_id) == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                    @endforeach
                </select>
                @error("category_id")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input @error("published") is-invalid @enderror" id="published" name="published" {{old("published", $post->published) ? "checked" : ""}}>
                <label class="form-check-label" for="published">Pubblica</label>
                @error("published")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <p>Tags</p>
                @foreach ($tags as $tag)
                    <div class="form-check-inline">
                        @if (old("tags"))
                            <input type="checkbox" class="form-check-input" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}" {{in_array($tag->id, old("tags", [])) ? "checked" : ""}}>
                        @else
                            <input type="checkbox" class="form-check-input" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}" {{$post->tags->contains($tag) ? "checked" : ""}}>
                        @endif
                        <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                    </div>
                @endforeach
                @error("tags")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
@endsection