
<input type="hidden" name="m1" value="{{ env('SERVICE_KEY') }}"> {{--Pay Now Service Key--}} 
<input type="hidden" name="m2" value="{{ env('VENDOR_KEY') }}"> {{-- Software Vendor Key--}} 
<input type="hidden" name="p2" value="{{ $transaction_id }}"> {{--Unique ID for this transaction--}} 
<input type="hidden" name="p3"  value="Seat reservation for, {{ $title }} by {{ $fullname }}, booking {{ $booking_id }} "> {{--Description of goods being purchased--}} 
<input type="hidden" name="p4" value="{{ $amount }}"> {{--Amount to be settled to the credit card--}}
<input type="hidden" name="Budget" value="N"> {{--Budget facility being offered?--}} 
<input type="hidden" name="m4" value="{{ $user_id }}"> {{--This is an extra field (user_id)--}} 
<input type="hidden" name="m5" value="{{ $booking_id }}"> {{--This is an extra field (Booking_id) --}} 
<input type="hidden" name="m6" value="{{ $event_id }}"> {{--This is an extra field  ($event_id) --}}
<input type="hidden" name="m9" value="{{ $email }}">
<input type="hidden" name="m10" value=""> {{--M10 data --}}
<button class="btn btn-success btn-sm" type="submit" name="submit"><i class="fa ion ion-social-usd"></i> {{ $buttonText or 'Pay Now!'}}</button>
{{--Submit button--}} 
