<?php
 
namespace App\Mail;
 
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
 
class userRegister extends Mailable
{
    use Queueable, SerializesModels;
 
    /**
     * Create a new message instance.
     */
    public function __construct(
        public User $user,
    ) {}
 
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'test-email',
            with: [
                'username' => $this->user->username,
                'name' => $this->user->name,
                'surname' => $this->user->surname,
                'email' => $this->user->email,
                'city' => $this->user->city,
                'activationStatus' => $this->user->activationStatus,
            ],
        );
    }
}