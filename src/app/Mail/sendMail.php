<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    // ユーザー情報格納用変数を用意
    protected $name;
    protected $email;
    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $token)
    {
        $this->name = $name;
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return self::to($this->email)->subject('認証メール')->view('auth.send-email')->with([
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->token
        ]);
    }
}
