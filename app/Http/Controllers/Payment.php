<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Category;

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
        $amount = $this->getPaymentAmountByTicketId($ticketId);

        $paymentDetails = [
            'id' => $ticketId,
            'amount' => $amount
        ];

        return view('tickets.payment', compact('paymentDetails'));
    }

    public function getPaymentAmountByTicketId(Int $TicketId){
    //   return Category::addSelect(['amount' => Ticket::select('category_id')
    //     ->where('id', $TicketId)
    //     ->limit(1)
    //     ])->get();
        return Ticket::find(1)->category->amount;
    }
}
