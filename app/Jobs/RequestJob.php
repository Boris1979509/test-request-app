<?php

namespace App\Jobs;

use App\Mail\RequestMailer;
use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

/**
 * Class RequestJob
 * @package App\Jobs
 */
class RequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Request $requestModel
     */
    private $requestModel;

    /**
     * RequestJob constructor.
     * @param Request $requestModel
     */
    public function __construct(Request $requestModel)
    {
        $this->requestModel = $requestModel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::to($this->requestModel->email)
            ->send(new RequestMailer($this->requestModel));
    }
}
