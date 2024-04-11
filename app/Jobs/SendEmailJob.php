<?php

namespace App\Jobs;

use App\Mail\JobMail;
use App\Mail\MyMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailTest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    

    /**
     * Create a new job instance.
     * @
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $email = new MyMail();
        // dd($email);
        foreach ($this->details as $detail) {
            // dd();
            // Example: Send email using MyMail class
            Mail::to($detail)->send(new JobMail($detail));
        }
        // Mail::to($this->details['email'])->send($email);
    }

    public function retryUntil()
    {
        return now()->addSeconds(10); // Retry after 10 seconds
    }
}
