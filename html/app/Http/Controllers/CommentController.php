<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentsRequest;
use App\Models\Comment;
use App\Models\Snippet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentsRequest $request) {

        //Validacion    -> StoreCommentsRequest

        $snippet = Snippet::where('slug', $request->snippet_slug)->first();

        if(!$snippet){
            return redirect()->back()->withErrors(['comment' => 'El snippet que intentas comentar no existe']);
        }


        if(!$user_id = Auth::user()->id){
            return redirect()->back()->withErrors(['comment' => 'Debes estar registrado para comentar']);
        }

        // Guardarlo en BD

        Comment::create([
            'user_id' => $user_id, 
            'snippet_id' => $snippet->id,
            'comment' => $request->comment
        ]);

        return redirect()->route('snippet.show', $snippet->slug);
    }



    public function destroy($id) {
        // dd("Estas intentando borrar el ", $id);

        $comment = Comment::find($id);

        if(!$comment){
            return back()->withErrors(['not-found' => "El comentario no existe"]);
        }

        $slug = $comment->snippet->slug;

        $comment->delete();

        return redirect()->route('snippet.show', ['slug' => $slug]);
    }
}
