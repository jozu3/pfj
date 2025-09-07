<?php

namespace App\Notifications;

use App\Models\Contacto;
use App\Models\Pfj;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewConsejeroObispoNotification extends Notification
{
    use Queueable;
    public $contacto;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contacto $contacto)
    {
        $this->contacto = $contacto;
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

        $pfj = Pfj::where('estado' ,'1')->first();

        return (new MailMessage)
            ->from('no-reply@gmail.com', config('app.name'))
            ->subject('Notificación de Pre-Inscripción de consejero')
            ->greeting('Bienvenido apreciado Obispo  ' . $this->contacto->obispo)
            ->line('Este es el Sistema Mi PFJ para la aprobación de consejeros y participantes. Ha recibido este correo porque un(a) joven de su barrio desea participar como consejero(a) en el '. $pfj->nombre)
            ->line('Para aprobarlo debe ingresar al siguiente botón: ') //. route('admin.contactos.index'))
            // ->line('Usuario: '.$this->inscripcione->personale->user->email)
            // ->line('Contraseña: password')
            // ->line('Te sugerimos que cambies tu contraseña en las próximas 24 horas, ingresando al menú perfil desde tu portal MiPFJ.')
            ->action('Portal Mi PFJ ', route('admin.contactos.index'))
            ->line('Bienvenido a una nueva experiencia.')
            ->salutation($pfj->lema);
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
