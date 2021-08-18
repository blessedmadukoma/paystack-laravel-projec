@extends('layouts.app')

@section('content')
<div class="jumbo">
  <form id="paymentForm" action="{{route('store')}}" method="POST">
    <h3>BU POST-GRADUATE APPLICATION FORM</h3>
    <br>
    <div class="form-group">
      <label for="first-name">First Name</label>
      <input type="text" id="first_name" name="first_name" />
    </div><br>
    <div class="form-group">
      <label for="last-name">Last Name</label>
      <input type="text" id="last_name" name="last_name" />
    </div><br>
    <div class="form-group">
      <label>Phone:</label>
      <input class="phone" type="tel" id="phone" name="phone">
    </div><br>

    <div>
      <p>Purpose:</p>
      <select id="purpose" name="purpose">
        <option value="Msc">Msc Programme</option>
        <option value="MPhil">MPhil Programme</option>
        <option value="PhD">PhD Programme</option>
        <option value="MBA">MBA Programme</option>
      </select>
    </div><br><br>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" class="email" id="email_address" name="email_address" />
    </div><br>
    <span>@error('content')* {{$message}} @enderror</span>
    <div class="form-group">
      <p class="amount">Amount:</p>
      <p class="main-amount"><strong>N21,500(+VAT)</strong></p>
    </div><br>

    <label for="accept"><input id="accept" type="checkbox">I confirm that all the details provided above are complete and correct.</label>


    <div class="form-submit">
      <button type="submit" name="submit">Confirm </button>
    </div>

    <script src=" https://js.paystack.co/v1/inline.js"></script>
  </form>

</div>
<script>

</script>

@endsection