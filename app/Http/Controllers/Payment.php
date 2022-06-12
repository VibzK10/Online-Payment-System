<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function show($ticketId)
    {

        // get from db by ticket id
        $amount = 100;

        $paymentDetails = [
            'id' => $ticketId,
            'amount' => $amount
        ];

        return view('tickets.payment', compact('paymentDetails'));
    }

}
