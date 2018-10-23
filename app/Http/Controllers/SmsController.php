<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class SmsController extends Controller
{
    public function page(){
        return view('superadmin.includes.sms');
    }
    public function sendSms(Request $request)
    {

        $accountSid = config('app.twilio')['AC58f5bee5c907ee47b15e22a6c7452afc'];
        $authToken  = config('app.twilio')['90106f0bc5d9de829cc2d5c2df7a82d9'];
        $appSid     = config('app.twilio')['SK5d8f303917a3eade9ce360f60260c0a0'];
        $client = new Client($accountSid, $authToken);
        try
        {
            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
            // the number you'd like to send the message to
                '+8801683731580',
                array(
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => '+13092478919',
                    // the body of the text message you'd like to send
                    'body' =>  $request->sms
                )
            );
        }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }

        return redirect()->back()->with('success','sms sent successfully');
    }


}
