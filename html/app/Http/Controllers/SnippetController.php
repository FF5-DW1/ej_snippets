<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Snippet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SnippetController extends Controller
{

    public function index(Request $request) {
        
        $snippets = Snippet::orderBy('updated_at', 'DESC')->get();

        return view('snippets.index', ['snippets' => $snippets]);

    }

    public function create(Request $request) {
        return view('snippets.new');
    }

    public function store(Request $request) {


        $slug = Str::slug($request->title, '-', 'es');

        $existe = Snippet::where('slug', $slug)->first();

        if($existe){
            return redirect()->route('home')->withErrors(['title' => 'Ese título ya existe']);
        }


        // VALIDATION
        $request->validate([
            // 'user_id'   => 'required|exists:users.id',
            'title'     => 'required|max:255',
            'description'     => 'required',
            'code'     => 'required'
        ]);


        $snippet = Snippet::create([
            'user_id' => 1,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'code' => $request->code,
        ]);

        return redirect()->route('home');

    }

    public function show(Request $request, $slug) {
        
        $user = Auth::user();
        $snippet = Snippet::where('slug', $slug)->first();

        $liked = ($snippet->likes()->where('user_id', $user->id)->first()) ? true : false;

        if(!$snippet){
            return abort(404);
        }

        return view('snippets.show', ['snippet' => $snippet, 'liked' => $liked]);

    }

    public function like(Request $request, $slug){
        // dd($slug);

        $user_id = Auth::id();

        if(!$user_id)   return back()->withError(['unauthenticated' => "Debes estar registrado para dar like"]);

        $snippet = Snippet::where('slug', $slug)->first();
        if(!$snippet)   return redirect("/")->withErrors(['not-found' => "Snippet no encontrado"]);

        $snippet_id = $snippet->id;

        // Buscar el like con ese user_id y snippet_id
        $existe = $snippet->likes()->where('user_id', $user_id)->first();

        // Si existe, elimino ese Like, guardado en la variable $existe;
        if($existe){
            
            // No tiene id primario (es clave compuesta ['user_id','snippet_id']) así que NO puedo usar $existe->delete()
            // $existe->delete();
            // Se elimina haciendo uso estático del modelo, filtrando con 2 where para obtener el Like. 
            Like::where('user_id', $user_id)->where('snippet_id', $snippet_id)->delete();
        }else{

            // SI NO existe, creo el Like.
    
            Like::create([
                'user_id' => $user_id,
                'snippet_id' => $snippet_id
            ]);
        }

        return redirect()->route('snippet.show', ['slug' => $snippet->slug]);

    }
}