@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Modifica il tag: {{$tag->name}}</h2>
        <form action="{{route("tags.update", $tag->id)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome" value="{{old("name", $tag->name)}}">
                @error("name")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
@endsection