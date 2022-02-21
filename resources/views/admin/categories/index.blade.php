@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <a href="{{route("categories.create")}}"><button type="button" class="btn btn-success">Aggiungi una categoria</button></a>
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
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slugCat}}</td>
                        <td>{{count($category->posts)}}</td>
                        <td>
                            <a href="{{route("categories.show", $category->id)}}"><button type="button" class="btn btn-primary">Più info</button></a>
                        </td>
                        <td>
                            <a href="{{route("categories.edit", $category->id)}}"><button type="button" class="btn btn-warning">Modifica</button></a>
                        </td>
                        <td>
                            <form action="{{route("categories.destroy", $category->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <a href="{{route("categories.destroy", $category->id)}}"><button type="submit" class="btn btn-danger">Elimina</button></a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection