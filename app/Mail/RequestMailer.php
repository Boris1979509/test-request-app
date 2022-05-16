<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class RequestMailer
 * @package App\Mail
 */
class RequestMailer extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Request $requestModel
     */
    public $requestModel;

    /**
     * RequestMailer constructor.
     * @param Request $requestModel
     */
    public function __construct(Request $requestModel)
    {
        $this->requestModel = $requestModel;
    }

    /**
     * @return RequestMailer
     */
    public function build()
    {
        return $this->subject(trans('Feedback form'))
            ->view('emails.request.update.response');
    }
}
