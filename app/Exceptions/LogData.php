<?php
 
namespace App\Exceptions;

use App\Models\DBLog;
use Exception;
use Illuminate\Support\Facades\Auth;
use Redirect;

class LogData extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report(){
    }
 
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception){
        // return 1;
      $log = new DBLog();
      $log->user_id = Auth::user()->id;
      $log->action = $request->fullUrl();
      $log->exception = $exception;
      $log->save(); 
    //   return $log;
      return \Redirect::back()->with('error', 'Something Went Wrong.');
    }
}