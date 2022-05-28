<?php

namespace App\Console\Commands;

use App\Http\Controllers\SubscribeController;
use App\Mail\NewPostMailable;
use App\Models\Email;
use App\Models\Post;
use App\Models\Subscribe;
use App\Models\User;
use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send subscribes emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscribes = Subscribe::all();
        foreach ($subscribes->all() as $subscribe) {
            $posts = Post::where('website', $subscribe->website);
            foreach ($posts->all() as $post) {
                if (Email::where('post', $post->id)->where('user', $subscribe->user)->get()->count() > 0) {
                    continue;
                }
                $user = User::where('id', $subscribe->user)->get()->first();
                Mail::to($user->email)->send(new NewPostMailable($post));
                $mail = new Email();
                $mail->user = $user->id;
                $mail->post = $post->id;
                $mail->save();
            }
        }

        return 0;
    }
}
