<?php

namespace App\Mail;

use App\UserTest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestResultEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\UserTest  $userTest
     */
    public $userTest;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserTest $userTest)
    {
        $this->userTest = $userTest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $result = "";

        if ($this->userTest->isPassed()) {
            $result = ": Passed";
        } elseif ($this->userTest->isFailed()) {
            $result = ": Failed";
        }

        return $this->view('emails.test-result-email')
            ->subject("Test Result {$result}");
    }
}
