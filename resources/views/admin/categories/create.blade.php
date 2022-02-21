@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Nuova categoria</h2>

        <form action="{{route("categories.store")}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome" value="{{old("name")}}">
                @error("name")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </div>
@endsection