<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            //postテーブルのidに存在する値のみ許容
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|max:2000',
        ]);

        $post = Post::findOrFail($params['post_id']);
        $post->comments()->create($params);
        $request->session()->flash('message','コメントの登録が完了しました。');

        return redirect()->route('posts.show', ['post' => $post]);
    }
}
