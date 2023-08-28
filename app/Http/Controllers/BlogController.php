<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    //
    public function index(){
        $nom = 'Arso';
        $prenom = 'Boss';

       /*  if(!Auth::check()){
            return view('login');
        } */

        //ou appeler auth de middelware au niveau de la route

        $blogs_list = Blog::all();

        
        return view('blog', compact("nom", "prenom", "blogs_list"));
    }

    public function createBlog(){
        return view('create-blog');
    }

    public function show($id=null){
        $nom = 'Arso';

        $data = Blog::find($id); //Blog::where("id", $id)->first()
        $ids = idsDB();

        //$ids = Blog::pluck("id")

        return view('blog', compact('nom', 'id', 'data'));
    }

    public function store(Request $request){

        $data = $request->all();

        $validation = $request->validate([
            "content" => "required",
            "title" => "required",
            "picture" => "required|mimes:jpg,png"
        ]);

        $file = $request->file("picture");
        $image = null;
        $name = $file->getClientOriginalName();
        $size = $file->getSize();

        if($request->hasFile("picture")){
            $image = $file->store('avatar');
        }

        //Possibility1 avec storage
        //$storage = Storage::disk("users");
        //$s = $storage->put($name, file_get_contents($file));

        //Possibility2 sans le storage
        

        //Possibility3
        //$s = $file->move(storage_path('users_public'), $name);

        //Possibility4
        //creer un dossier sois meme sur le filesysteme 

        

        $save = Blog::create([
            "title" => $data['title'],
            "content" => $data['content'],
            "picture" => $image
        ]);

        return redirect()->route('index')->with("message", "Success saved !");
    }
}