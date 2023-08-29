<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
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

        //faire la mise à jour pour mettre la date de la verification et la verification à true
        $user->update([
            "email_verified_at" => now(),
            "email_verified" => true
        ]);

        //retourne sur la page de connection avec un message
        return redirect()->route("login")->with("success", "Compte activé avec succès !");
    }
    //
}
