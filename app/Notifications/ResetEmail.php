<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetEmail extends Notification
{
	use Queueable;

	public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
	{
		$this->token = $token;
	}

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
	{
		return ['mail'];
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
			->subject('メールアドレスの変更について')
			->line('下記をクリックし認証されるとメールアドレスが変更されます。')
			->line('なお、有効期限は本メールが送信されてから３０分です。')
			->action('メールアドレス変更', url(route('email.reset', $this->token)))
			->line('このメールに覚えのない場合には、お手数ですがメールを破棄してください。');
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
