@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            Ticket #{{ $paymentDetails['id'] }}
            <br>
            Amount to be paid : Rs {{ $paymentDetails['amount'] }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@stop
