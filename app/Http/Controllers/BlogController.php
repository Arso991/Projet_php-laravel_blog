<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class BlogController extends Controller
{
    //methode pour afficher la page d'acceuil
    public function index(){
        //on recupere l'utilisateur qui est connecte avec la classe Auth
        $user = Auth::user();
        //condition ternaire, si l'user existe, ca recupere le nom sinon rien
        $nom = $user ? $user->firstname :'';
        $prenom = $user ? $user->lastname :'';

       /*  if(!Auth::check()){
            return view('login');
        } */
        //ou appeler auth de middelware au niveau de la route

        //$blogs_list = Blog::paginate(3);

        //recuperation des blogs selon l'utilisateur qui est connecté
        //$blogs_list = Blog::where("user_id", $user->id)->get();

        $blogs_list = $user->blogs;
      
        return view('blog', compact("nom", "prenom", "blogs_list"));
    }
    //methode pour afficher tous les articles
    public function all(){
        $user = Auth::user();
        $nom = $user ? $user->firstname:'';
        $prenom = $user ? $user->lastname:'';

       /*  if(!Auth::check()){
            return view('login');
        } */
        //ou appeler auth de middelware au niveau de la route

        $blogs_list = Blog::paginate(3);

        //$blogs_list = Blog::where("user_id", $user->id)->get();

        return view('blog', compact("nom", "prenom", "blogs_list"));
    }
    //methode pour afficher le formulaire d'ajout d'article
    public function createBlog(){
        return view('create-blog');
    }
    //methode pour afficher les details d'un article
    public function show($id=null){
        $nom = 'Arso';

        $data = Blog::find($id); //Blog::where("id", $id)->first()
        $ids = idsDB();
        //permet de revuperer les id dans un tableau
        //$ids = Blog::pluck("id")

        return view('blog', compact('nom', 'id', 'data'));
    }
    //methode qui permet d'"nvoyer un article dans la BD
    public function store(Request $request){

        $data = $request->all();

        $validation = $request->validate([
            "content" => "required",
            "title" => "required",
            /* "picture" => "required|mimes:jpg,png", */
        ]);
        //on recupere le fichier dans la variable file, il ne faut pas oublier de mettre enctype au niveau du formulaire 
        /* $file = $request->file("picture");
        $image = null; */

        //pour avoir le nom de l'image
        //$name = $file->getClientOriginalName();
        //pour avoir la taille de l'image
        //$size = $file->getSize();

        //verifier si dans request il y une donnée de type file qui porte le nom de picture
        //si ca existe on l'enregistre dans la variable image

       /*  if($request->hasFile("picture")){
            $image = $file->store('avatar');
        } */

        //Possibility1 avec storage
        //$storage = Storage::disk("users");
        //$s = $storage->put($name, file_get_contents($file));

        //Possibility2 sans le storage
        

        //Possibility3
        //$s = $file->move(storage_path('users_public'), $name);

        //Possibility4
        //creer un dossier sois meme sur le filesysteme 

        
        //sauvegarder dans la BD avec $save
        $save = Blog::create([
            "title" => $data['title'],
            "content" => $data['content'],
            "picture" => 'image',
            "user_id" => Auth::user()->id
        ]);

        /* return redirect()->route('index')->with("message", "Success saved !"); */
        return response()->json(['message' => 'Enrégistré avec succès !']);
    }

    public function printblog(){
        $blogs = Blog::all();

        $pdf = Pdf::loadView('print',['blogs'=>$blogs]);

        $pdf->setPaper('A5','landscape');

        return $pdf->stream('Blog_list.pdf');
    }
}