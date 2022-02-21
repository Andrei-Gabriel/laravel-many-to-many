@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <a href="{{route("tags.create")}}"><button type="button" class="btn btn-success">Aggiungi un tag</button></a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Slug</th>
                    <th scope="col">N.</th>
                    <th scope="col">Actions</th>
                    {{-- Altrimenti i bordi fanno schifo --}}
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <th scope="row">{{$tag->id}}</th>
                        <td>{{$tag->name}}</td>
                        <td>{{$tag->slug}}</td>
                        <td>{{count($tag->posts)}}</td>
                        <td>
                            <a href="{{route("tags.show", $tag->id)}}"><button type="button" class="btn btn-primary">Più info</button></a>
                        </td>
                        <td>
                            <a href="{{route("tags.edit", $tag->id)}}"><button type="button" class="btn btn-warning">Modifica</button></a>
                        </td>
                        <td>
                            <form action="{{route("tags.destroy", $tag->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <a href="{{route("tags.destroy", $tag->id)}}"><button type="submit" class="btn btn-danger">Elimina</button></a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection