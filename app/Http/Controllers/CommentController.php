<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store( Request $request, User $user, Post $post) {

        // Validar
        $this->validate( $request, [
            'comment' => 'required|max:255',
        ]);

        // Almacenar 

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' => $request->comment,
        ]);

        return back()->with('message', 'Comentario publicado');

    }
}
