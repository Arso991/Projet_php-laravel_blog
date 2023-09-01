<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function listUser(){
        $list = User::active()->get();
    }
    //fonction pour afficher la page de connexion
    public function login(){
        return view('login');
    }

    //fonction pour afficher la page d'inscription
    public function register(){
        return view('register');
    }

    //fonction pour envoyer les données dans la BD et vérifications nécessaires
    public function store(Request $request){
        $data = $request->all();

        //validation du formulaire
        $request->validate([
            "lastname" => "required|min:2",
            'firstname' => 'required|min:2',
            'email' => array(
                "required",
                "unique:users",
                "regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/"

            ),
            'password' => array(
                "required",
                "regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[@$!%*?&#^_;:,])[A-Za-z\d@$!%*?&#^_;:,].{8,}$/",
                "confirmed:password_confirmation"
            ),
        ]);

        //sauvegarde temporaire
        $save = User::create([
            "lastname" => $data["lastname"],
            "firstname" => $data["firstname"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            "birthday" => $data["birthday"],
        ]);

        //création de l'url d'activation
        $url = URL::temporarySignedRoute(
            'verifyEmail',now() -> addMinutes(30), ['email' => $data['email']]
        );

        //envoie de l'url generer par mail pour activation du compte
        //send(prend en parametre la vue, params(ici c'est le nom de celui qui s'inscrire) et une fonction callback)
        Mail::send('mail',['url' => $url, "name"=>$data['lastname'].' '.$data['firstname']], function($message) use($data){
            //pour acceder au fichier mail dans config
            $config = config('mail');
            //concatener le nom et le prenom de celui qui s'inscrire dans une variable name
            $name = $data['lastname'].' '.$data['firstname'];
            //le message qui sera envoyé par mail, ca prend un sujet, celui qui envoie, c'est a dire le serveur qui envoie le message
            //et le destinataire, c'est à dire le mail entrer par l'utilisateur 
            $message->subject("Registration verification !") //le sujet du mail
                    ->from($config['from']['address'], $config['from']['name']) //mail qui envoie le message
                    ->to($data['email'], $name); //mail qui recoit le message
        });

        //reviens sur la page d'inscription avec un message en attendant la validation du compte
        return redirect()->back()->with("success", "Veuillez consulter votre mail pour activer votre compte utilisateur");
    }

    public function verify(Request $request, $email){
        $user = User::where("email", $email)->first();

        //si le mail n'existe pas
        if(!$user){
            abort(404);
        }

        //verifie si la signature est valide, si c'est au dela du temps de validité
        if(! $request->hasValidSignature()) {
            abort(404);
        }

        //faire la mise à jour pour mettre la date de la verification et la verification à true pour signifier que
        //l'email a été vérifié
        $user->update([
            "email_verified_at" => now(),
            "email_verified" => true
        ]);

        //retourne sur la page de connection avec un message
        return redirect()->route("login")->with("success", "Compte activé avec succès !");
    }
    
    //fonction qui mène sur la page de récupération de compte
    public function recovery(){
        return view('recovery');
    }
    //methode qui envoie le mail de récupération à partir d'un mail qui existe deja dans la BD
    public function change(Request $request){

        $data = $request->all();

        $request->validate([
            'email' => array(
                "required",
                "regex:/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/"
            )
            ]);

            $email = $data['email'];
            //verifie si le mail existe deja dans la BD
            $exists = User::where('email', $email)->exists();
            //si oui, envoie le mail pour passer sur la page de recuperation
            if($exists){
                $host = URl::temporarySignedRoute('check', now() -> addMinutes(10), ['email' => $email]);

                Mail::send('newpassword',['host'=>$host, 'email' => $email], function($message) use($data){
                    $config = config('mail');
                    $message->subject('Renouvellement de mot de passe !')
                            ->from($config['from']['address'], $config['from']['name'])
                            ->to($data['email']);
                });
                //sinon, retoure sur la page avec un message d'erreur
            }else{
                return redirect()->back()->with('error', 'Veuillez entrer une addresse mail valide');
            }

            return redirect()->back()->with("validate", "Veuillez consulter votre mail pour renouveler votre mot de passe");
    }
    //methode de la route temporaire
    public function check(Request $request, $email){
        $user = User::where('email', $email);

        if(!$user){
            abort(404);
        }
        //verifie si la signature envoyée est toujours valide
        if(!$request->hasValidSignature()){
            return redirect()->route('recovery')->with('failed', 'Votre lien a expiré, veuillez reéssayer');
        }

        return view('changepassword', compact('email'));
        
    }
    //methode qui met à jour le mot de passe
    public function updatepassword(Request $request, $email){
        $user = User::where('email', $email)->first();

        if(!$user){
            abort(404);
        }

        $data = $request->all();

        $request->validate([
            'password' => array(
                "required",
                "regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[@$!%*?&#^_;:,])[A-Za-z\d@$!%*?&#^_;:,].{8,}$/",
                "confirmed:password_confirmation"
            )
            ]);

            $user -> update([
                "password" => Hash::make($data['password']),
            ]);

        return redirect()->back()->with('verified', 'Vous pouvez vous connecter avec votre nouveau mot de passe.');
    }
    //methode pour faire l'authentification
    public function authentification(Request $request){

        $users = Auth::attempt([
            'email'=>$request->email, 
            'password'=>$request->password,
            'email_verified'=>true
        ]);

        if($users){
            return redirect()->route('index');
        }

        return redirect()->back()->with('error', '[Combinaison email/password invalide !]');
        /* dd(Auth::user()); */
    }
    //mrthode pour se deconnecter
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
