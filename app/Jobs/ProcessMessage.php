<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    // public function handle()
    // {
    //     try {
    //         Log::info('Processing message...', ['message_id' => $message->id]);  // for error grnrate
    //         Log::info('Processing a message...');
    //     } catch (\Exception $e) {
    //         Log::warning('An Warning occurred: ' . $e->getMessage());
    //     }catch (\Exception $e) {
    //         Log::error('An error occurred: ' . $e->getMessage());
    //     }catch (\Exception $e) {
    //         Log::error('An error occurred: ' . $e->getMessage());
    //     }catch (\Exception $e) {
    //         Log::error('An error occurred: ' . $e->getMessage());
    //     }
        
        
    // }
}
