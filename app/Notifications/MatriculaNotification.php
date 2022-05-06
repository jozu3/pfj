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
                    ->greeting(Lang::get('Hello!') . ' ' . $this->inscripcione->personale->contacto->nombres)
                    ->line('Te damos una cordial bienvenida a la especialización de '.$this->inscripcione->grupo->pfj->nombre.' que inicia el '.date( 'd/m/Y', strtotime($this->inscripcione->grupo->fecha)).'. En este correo encontrarás tu usuario y contraseña de la plataforma donde podrás visualizar los pagos que realices correspondientes a tus pfjs y las notas de tus unidades educativas terminadas, asimismo los comentarios y recomendaciones del docente en cada unidad.')
                    ->line('Debes ingresar a '. route('st.index'))
                    ->line('Usuario: '.$this->inscripcione->personale->user->email)
                    ->line('Contraseña: password')
                    ->line('Te sugerimos que cambies tu contraseña en las próximas 24 horas, ingresando al menú perfil desde tu portal de estudiante.')
                    ->action('Portal de estudiante de PFJ Perú', url('/st'))
                    ->line('Bienvenido a una nueva experiencia de aprendizaje.')
                    ->salutation("La excelencia es el camino");

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
