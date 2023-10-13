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
    public $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Inscripcione $inscripcione, $password)
    {
        $this->inscripcione = $inscripcione;
        $this->password = $password;
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
        $url_action = config('app.url_prod');
        switch ($this->inscripcione->role->slug) {
            case 'consejero':
                $url_action = url('/st');
                break;
            case 'obispo':
                $url_action = route('admin.contactos.index');
                break;
            case 'matrimonio_apoyo':
                $url_action = route('admin.contactos.index');
                break;
            default:
                $url_action = config('app.url_prod');
                break;
        }


        return (new MailMessage)
            ->from('no-reply@pfjperu.com', config('app.name'))
            ->subject('¡Felicidades! Ya estás inscrito al PFJ 2024')
            ->greeting(Lang::get('Hello!') . ' ' . $this->inscripcione->personale->contacto->nombres)
            ->line('Te damos una cordial bienvenida al '.$this->inscripcione->programa->nombre/*.' que inicia el '.date( 'd/m/Y', strtotime($this->inscripcione->programa->fecha_inicio))*/.'. En este correo encontrarás tu usuario y contraseña de la plataforma MiPFJ')
            ->line('Debes ingresar a '. config('app.url'))
            ->line('Rol: '. $this->inscripcione->role->name)
            ->line('Usuario: '.$this->inscripcione->personale->user->email)
            ->line($this->password == '' ? 'Si olvidaste tu contraseña ingresa al link y pon olvidé mi contraseña.': 'Contraseña: '.$this->password)
            ->line($this->password != ''?'Te sugerimos que cambies tu contraseña en las próximas 24 horas, ingresando al menú perfil desde tu portal MiPFJ.': '')
            ->action('Portal MiPFJ ', $url_action)
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
