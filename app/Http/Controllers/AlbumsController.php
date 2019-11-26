<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Album;

class AlbumsController extends Controller
{
    /**
     * Create new controller instance
     * 
     * return void
     */
    public function __construct(){
        $this->middleware('auth',['except' => ['index', 'show']]);
    }

    public function index(){
        $albums = Album::with('Photos')->get();
        return view('albums/projects')->with('albums', $albums);
    }

    public function create(){
        return view('albums/create');
    }

    public function edit($id){
        $album = Album::with('Photos')->find($id);
        return view('albums/edit')->with('album', $album);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image | max:10000'
        ]);

        //get filename with extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        
        //get extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();

        //create new file name
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        //upload image
        $path = $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);

        //create album
        $album = new Album;
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->type = $request->input('type');
        $album->cover_image = $filenameToStore;

        $album->save();

        return redirect('/albums')->with('success', 'Album created');
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image | max:10000'
        ]);

        if($request->hasFile('cover_image')){
            
        //get filename with extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        
        //get extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();

        //create new file name
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        //upload image
        $path = $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);
        }

        //create album
        $album = Album::with('Photos')->find($id);
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        if ($request->hasFile('cover_image')) {
            Storage::delete('public/album_covers/' . $album->cover_image);
            $album->cover_image = $filenameToStore;
        }

        $album->save();

        return redirect('/albums')->with('success', 'Album updated');

    }

    public function show($id){
        $album = Album::with('Photos')->find($id);
        return view('albums/show')->with('album', $album);
    }

    public function destroy($id){
        $album = Album::with('Photos')->find($id);

        if(Storage::delete('public/album_covers/'.$album->cover_image)){
            $album->delete();
        }

        if(Storage::deleteDirectory('public/photos/'.$album->id)) {
            $album->delete();
        }

        return redirect('/albums')->with('success', 'Album Deleted');
    }
}
