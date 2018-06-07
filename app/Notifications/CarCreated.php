<?php

namespace FederalSt\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CarCreated extends Notification
{
    use Queueable;

    protected $car_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(int $car_id)
    {
        $this->car_id = $car_id;
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
            ->level('info')// It is kind of email. Available options: info, success, error. Default: info
            ->line(trans('message.notification_created_car_line'))
            ->action(trans('message.notification_car_action'), url('/cars/view/' . $this->car_id))
            ->line(trans('message.notification_thank_you'));
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
