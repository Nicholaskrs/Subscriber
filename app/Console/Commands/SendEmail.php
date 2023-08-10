<?php

namespace App\Console\Commands;

use App\Jobs\SendingEmail;
use App\Mail\NewPost;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $subscribers = Subscriber::chunk(1000, function ($subscribers) {
            foreach ($subscribers as $subscriber) {
                $sendedEmail = $subscriber->posts->where('is_send', 1)->pluck('id');
                $posts = Post::where('website_id', $subscriber->website_id)
                    ->whereNotIn('id', $sendedEmail)
                    ->chunk(1000, function ($posts) use ($subscriber) {
                        foreach ($posts as $post) {
                            SendingEmail::dispatch($subscriber, $post);
                        }
                    });
            }
        });
        return 0;
    }
}
