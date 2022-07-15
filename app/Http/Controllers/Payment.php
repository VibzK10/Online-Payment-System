<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Seshac\Otp\Otp;
use Mail;
use PDO;
use stdClass;

class Payment extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

      /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $ticketId)
    {

        $access = false;
        $offenderEmail = Ticket::find($ticketId)->author_email;
        $offenderName = Ticket::find($ticketId)->title;
        $msg = '';

        if($request->session()->has('haveAccess')){
            $access = true;
        }

        if(!empty($request->input('otp'))){

            $verify = Otp::validate($offenderEmail, $request->input('otp'));
            if($verify->status){
                $request->session()->put('haveAccess', true);
                $access = true;
            }else{
                $msg = $verify->message;
            }
        }

        if(!$access){

            $otp =  Otp::setValidity(3)  // otp validity time in mins
            ->setLength(6)  // Lenght of the generated otp
            ->setMaximumOtpsAllowed(3) // Number of times allowed to regenerate otps
            ->setOnlyDigits(true)  // generated otp contains mixed characters ex:ad2312
            ->setUseSameToken(false) // if you re-generate OTP, you will get same token
            ->generate($offenderEmail);

            if(isset($otp->token)){
                $this->sendMailToOffender($offenderEmail, $otp->token, $ticketId, $offenderName);
            }

        }

        // get from db by ticket id
        $amount = $this->getPaymentAmountByTicketId($ticketId);

        $paymentDetails = [
            'id' => $ticketId,
            'amount' => $amount,
            'haveAccess' => $access
        ];
        if($access){
            return view('tickets.payment', compact('paymentDetails'));
        }else{
            $ticket = new stdClass;
            $ticket->id = $ticketId;
            return view('tickets.otp', compact('ticket','msg'));
        }
    }

    public function getPaymentAmountByTicketId(Int $ticketId){
        return Ticket::find($ticketId)->category->amount;
    }

    public function sendMailToOffender(String $email, Int $otp, Int $ticketId, String $offenderName ){

        $emailData['email'] = $email;
        $emailData['offenderName'] = $offenderName;
        $pageData['otp'] = $otp;
        $pageData['offenderName'] = $offenderName;
        $pageData['ticketId'] = $ticketId;
        Mail::send('emails.otp', $pageData, function($message) use ($emailData) {
            $message->to($emailData['email'], $emailData['offenderName'])->subject
               ('FinePay - Your OTP expires in 3 minutes');
            $message->from('no-reply@finepay.com','FinePay');
         });
    }

}
