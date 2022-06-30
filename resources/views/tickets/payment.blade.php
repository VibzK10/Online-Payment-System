@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-3">
            <div class="col-md-12"><h2>Direct payment via Juice / Bank transfer</h2></div>
            <div class="col-md-12 text-center text-danger p-3"> <h3>Please send the exact amout to the account number provided below or send by Juice to this number. </h3></div>
            <div class="col-md-12 text-center p-3"><img src="https://www.mcb.mu/resource/juice/images/logo.png" alt="mcb logo"></div>
                    Ticket summary:

                    <table class="w-100">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Ticket</td>
                        <td>#{{ $paymentDetails['id'] }}</td>
                    </tr>
                    <tr>
                        <td>Amount to be paid</td>
                        <td>Rs {{ $paymentDetails['amount'] }}</td>
                    </tr>
                    <tr>
                        <td>Account Number</td>
                        <td>MCB-6545515151651</td>
                    </tr>
                    <tr>
                        <td>Juice Number</td>
                        <td>250X5000</td>
                    </tr>
                    </tbody>
                    </table>

                    <div class="col-md-12 p-3">

                        <p class="text-dark"> * Please note that once the payment has been complete, the conserned department will review the payment and close the ticket accordingly within 48 hours upon reception of payment.</p>
                        <p class="text-dark"> Once the ticket is closed, you will be informed by email.</p>
                        <p class="text-dark"> If you have any question, please contact the support officer (+230 250X000)</p>

                    </div>
                <div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>

</script>
@stop
