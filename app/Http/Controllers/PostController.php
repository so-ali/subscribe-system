<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user' => 'required|exists:users,id',
            'site' => 'required|exists:websites,id',
            'title' => 'required|string',
            'content' => 'string',
        ]);
        if ($validate->fails()) {
            return $validate->getMessageBag();
        }

        $post = new Post();
        $post->user = $request->get('user');
        $post->website = $request->get('site');
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->save();
        return [
            'message' => 'Created as successfully.'
        ];
    }
}
