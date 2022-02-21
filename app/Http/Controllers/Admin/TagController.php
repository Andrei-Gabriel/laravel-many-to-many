<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view("admin.tags.index", compact("tags"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.tags.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione
        $request->validate([
            "name" => "required|string|max:255|unique:tags,name"
        ]);
        $data = $request->all();

        // Creo il tag
        $newTag = new Tag();
        $newTag->name = $data["name"];
        $newTag->slug = Str::of($newTag->name)->slug("-");
        $newTag->save();

        // Redirect al tag creato
        return redirect()->route("tags.show", $newTag->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view("admin.tags.show", compact("tag"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view("admin.tags.edit", compact("tag"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        // Validazione
        $request->validate([
            "name" => "required|string|max:255|unique:categories,name,{$tag->id}"
        ]);
        $data = $request->all();

        // Modifico il tag
        $tag->name = $data["name"];
        $tag->slug = Str::of($tag->name)->slug("-");
        $tag->save();

        // Redirect al tag modificato
        return redirect()->route("tags.show", $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route("tags.index");
    }
}
