<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use App\Models\Inscripcione;

class InscripcioneNotification extends Notification
{
    use Queueable;

    public $inscripcione;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Inscripcione $inscripcione)
    {
        $this->inscripcione = $inscripcione;
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
                    ->from('no-reply@pfjperu.com', config('app.name'))
                    ->subject('Notificación de Inscripción')
                    ->greeting(Lang::get('Hello!') . ' ' . $this->inscripcione->personale->contacto->nombres)
                    ->line('Te damos una cordial bienvenida al '.$this->inscripcione->programa->nombre.' que inicia el '.date( 'd/m/Y', strtotime($this->inscripcione->programa->fecha_inicio)).'. En este correo encontrarás tu usuario y contraseña de la plataforma MiPFJ')
                    ->line('Debes ingresar a '. config('app.url'))
                    ->line('Usuario: '.$this->inscripcione->personale->user->email)
                    ->line('Contraseña: password')
                    ->line('Te sugerimos que cambies tu contraseña en las próximas 24 horas, ingresando al menú perfil desde tu portal MiPFJ.')
                    ->action('Portal MiPFJ ', url('/st'))
                    ->line('Bienvenido a una nueva experiencia.')
                    ->salutation($this->inscripcione->programa->pfj->lema);

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
