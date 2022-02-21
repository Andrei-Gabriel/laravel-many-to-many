@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Modifica la categoria: {{$category->name}}</h2>
        <form action="{{route("categories.update", $category->id)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome" value="{{old("name", $category->name)}}">
                @error("name")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
@endsection