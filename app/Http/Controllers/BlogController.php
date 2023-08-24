<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Http\UploadedFile;

class BlogController extends Controller
{
    //
    public function index(){
        $nom = 'Arso';
        $prenom = 'Boss';
        $blogs_list = Blog::all();

        
        return view('blog', compact("nom", "prenom", "blogs_list"));
    }

    public function createBlog(){
        return view('create-blog');
    }

    public function show($id=null){
        $nom = 'Arso';

        $data = Blog::find($id); //Blog::where("id", $id)->first()
        return view('blog', compact('nom', 'id', 'data'));
    }

    public function store(Request $request){

        $data = $request->all();

        $validation = $request->validate([
            "content" => "required",
            "title" => "required"
        ]);

        
        $save = Blog::create([
            "title" => $data['title'],
            "content" => $data['content']
        ]);

        return redirect()->route('index')->with("message", "Success saved !");
    }
}