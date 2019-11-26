<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photos;

class PhotosController extends Controller
{

    /**
     * Create new controller instance
     * 
     * return void
     */
    public function __construct(){
        $this->middleware('auth',['except' => ['index', 'show']]);
    }

    public function create($album_id){
        return view('photos/create')->with('album_id', $album_id);
    }

    public function edit($id){
        $photo = Photos::find($id);
        return view('photos/edit')->with('photo', $photo);
    }

    public function store(Request $request){
        $this->validate($request, [
            'photo' => 'required',
            'photo[]' => 'image | mimes:jpg, png, gif, tif, jpeg | max:64000'
        ]);
            
        $photos = $request->file('photo');
        $path  = [];
        if($request->hasFile('photo')){

            foreach($photos as $photo){
                //get filename with extension
                $filenameWithExt = $photo->getClientOriginalName();

                //get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                
                //get extension
                $extension = $photo->getClientOriginalExtension();

                //create new file name
                $filenameToStore = $filename.'_'.time().'.'.$extension;

                //get file size
                $filesize = $photo->getClientSize();

                //upload image
                $path[] = $photo->storeAs('public/photos/'.$request->input('album_id'), $filenameToStore);

                $photo = new Photos;
                $photo->album_id = $request->input('album_id');
                $photo->size = $filesize;
                $photo->photo = $filenameToStore;
                $photo->save();
            }
        }
        
        return redirect('/albums/'.$request->input('album_id'))->with('success', 'Photo Uploaded');
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'photo' => 'required | max:15000'
        ]);
    
       if ($request->hasFile('photo')) {
            //get filename with extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();

            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            //get extension
            $extension = $request->file('photo')->getClientOriginalExtension();

            //create new file name
            $filenameToStore = $filename.'_'.time().'.'.$extension;

            //get file size
            $filesize = $request->file('photo')->getClientSize();

            $path = $request->file('photo')->storeAs('public/photos/'.$request->input('album_id'), $filenameToStore);
            
       }   
        
        $photo = Photos::find($id);
        $photo->album_id = $request->input('album_id');
        $photo->size = $filesize;
        if ($request->hasFile('photo')) {
            Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo);
            $photo->photo = $filenameToStore;
        }
        $photo->save();
        
        return redirect('/albums/'.$request->input('album_id'))->with('success', 'Photo updated');
    }

    public function show($id){
        $photo = Photos::find($id);
        return view('photos/show')->with('photo', $photo);
    }

    public function destroy(Request $request, $id){

        $photo = Photos::find($id);

        if(Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo)){
            $photo->delete();

            return redirect('/albums/'.$request->input('album_id'))->with('success', 'Photo deleted');
        }
    }
}
