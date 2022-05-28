<?php

namespace App\Http\Controllers;

use App\Mail\NewPostMailable;
use App\Models\Email;
use App\Models\Post;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user' => 'required|exists:users,id',
            'site' => 'required|exists:websites,id'
        ]);
        if ($validate->fails()) {
            return $validate->getMessageBag();
        }
        $check = Subscribe::where('user', $request->get('user'))->where('website', $request->get('site'))->get();

        if ($check->count() > 0) {
            return [
                'message' => 'Already subscribed'
            ];
        }

        $subscribe = new Subscribe();
        $subscribe->user = $request->get('user');
        $subscribe->website = $request->get('site');
        $subscribe->save();

        return [
            'message' => 'Successfully'
        ];
    }

    public function notify(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'post' => 'required|exists:posts,id',
            'site' => 'required|exists:websites,id'
        ]);
        if ($validate->fails()) {
            return $validate->getMessageBag();
        }
        $subscribes = Subscribe::where('website', $request->get('site'))->get();
        $post = Post::where('id', $request->get('post'))->get();

        if ($subscribes->count() > 0) {
            foreach ($subscribes->all() as $item) {
                if (Email::where('post', $post->first()->id)->where('user', $item->id)->get()->count() > 0) {
                    continue;
                }
                Mail::to($item->email)->send(new NewPostMailable($post->first()));
                $mail = new Email();
                $mail->user = $item->id;
                $mail->post = $post->first()->id;
                $mail->save();
            }
        }

        return [
            'message' => 'Successfully'
        ];
    }
}
