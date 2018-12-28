<?php

namespace App\Http\Resources;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * 
     * @return void
     */

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function createEmail()
    {
        /*CREATE VIEW - EM FALTA*/
        return $this->view('')->with("userId", $this->userId)->from('teste@email.pt', 'TESTE')->cc("teste@mail.pt", "123123")->subject("TESTE");
    }
}
