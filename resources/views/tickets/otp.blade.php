@extends('layouts.app')

@section('content')

<form class="otc" name="one-time-code" action="{{ route("tickets.postOTP", $ticket->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
	<fieldset>
		<legend>Please enter your OTP (Please check your email) <span>@if(isset($msg) && $msg != '') <br> <span class="text-red"> {{ $msg }} </span> @endif</legend>
		<label for="otc-1">Number 1</label>
		<label for="otc-2">Number 2</label>
		<label for="otc-3">Number 3</label>
		<label for="otc-4">Number 4</label>
		<label for="otc-5">Number 5</label>
		<label for="otc-6">Number 6</label>

		<!-- https://developer.apple.com/documentation/security/password_autofill/enabling_password_autofill_on_an_html_input_element -->
		<div>
		<input type="number" pattern="[0-9]*"  value="" inputtype="numeric" autocomplete="one-time-code" id="otc-1" required>

		<!-- Autocomplete not to put on other input -->
		<input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1"  value="" inputtype="numeric" id="otc-2" required>
		<input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1"  value="" inputtype="numeric" id="otc-3" required>
		<input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1"  value="" inputtype="numeric" id="otc-4" required>
		<input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1"  value="" inputtype="numeric" id="otc-5" required>
		<input type="number" pattern="[0-9]*" min="0" max="9" maxlength="1"  value="" inputtype="numeric" id="otc-6" required>
		</div>
	</fieldset>

    <input type="hidden" id="finalOTPholder" name="otp" value="">

    <!-- <input type="sumbit" value="Submit" class="btn btn-primary" > -->
</form>
<!-- <div class="col-md-12 text-center">
    <a class="resendOTP p-3 pe-cursor">Resend OTP</a>
</div> -->
@endsection

