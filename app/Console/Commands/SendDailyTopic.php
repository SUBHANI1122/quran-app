<?php

namespace App\Console\Commands;

use App\Services\FirebaseService;
use App\Models\Topic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendDailyTopic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:daily-topic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a random topic to the Firebase topic "daily_topic"';
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        parent::__construct();
        $this->firebase = $firebase;
    }



    /**
     * Execute the console command.
     */
    public function handle()
    {
        $topic = Topic::inRandomOrder()->first();

        if (!$topic) {
            $this->error('No topics found in the database.');
            return;
        }

        $title = $topic->name;
        $body = $topic->description;

        $this->firebase->sendToTopic('daily_topic', $title, $body, [
            'topic_id' => (string) $topic->id
        ]);

        Log::info("✅ Sent topic notification: {$topic->name}");


        $this->info("Notification sent: {$topic->name}");
    }
}
