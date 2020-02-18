<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twitter\TwitterChannel;
use NotificationChannels\Twitter\TwitterStatusUpdate;

class TweetNewPRMerged extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [TwitterChannel::class];
    }

    public function toTwitter($pullRequest)
    {
        $url = route('pr_view', ['id' => $pullRequest->id]);
        $message = sprintf('%s by %s. %s', $pullRequest->title, $pullRequest->author_name, $url);

        return new TwitterStatusUpdate($message);
    }
}
