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
        $message = sprintf('%s by %s. %s', $pullRequest->title, $pullRequest->author->name, $pullRequest->url);

        return new TwitterStatusUpdate($message);
    }
}
