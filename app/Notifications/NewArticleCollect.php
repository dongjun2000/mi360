<?php

namespace App\Notifications;

use App\Article;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewArticleCollect extends Notification
{
    use Queueable;

    public $user;

    public $article;

    public $is_collect;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Article $article, $is_collect)
    {
        $this->user = $user;

        $this->article = $article;

        $this->is_collect = $is_collect;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'user'    => [
                'id'     => $this->user->id,
                'name'   => $this->user->name,
                'avatar' => $this->user->avatar,
            ],
            'article' => [
                'id'    => $this->article->id,
                'title' => $this->article->title,
                'pic'   => $this->article->pic,
                'type'  => $this->article->type,
                'intro' => $this->article->intro,
            ],
            'is_collect'  => $this->is_collect,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
