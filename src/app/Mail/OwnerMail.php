<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OwnerMail extends Mailable
{
    use Queueable, SerializesModels;

    // メール情報格納用の変数を用意
    protected $title;
    protected $content;
    protected $base_email;
    protected $name;
    protected $send_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $content, $name, $email)
    {
        $this->title = $title;
        $this->content = $content;
        $this->base_email = config('owner.owner_mail');
        $this->name = $name;
        $this->send_email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return self::to($this->send_email)->from(config('owner.owner_mail'))->subject('お知らせメール')->view('owner.send')->with([
            'title' => $this->title,
            'content' => $this->content,
            'name' => $this->name
        ]);
    }
}
