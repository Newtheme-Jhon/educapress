<?php

namespace App\Mail;

use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyQuestionLessonEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $question;
    public $lesson;

    /**
     * Create a new message instance.
     */
    public function __construct(Question $question, Lesson $lesson)
    {
        $this->question = $question;
        $this->lesson = $lesson;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificación de comentario de Lección',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.notify-question-lesson-email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
