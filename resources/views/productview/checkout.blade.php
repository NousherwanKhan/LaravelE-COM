@extends('layouts.navbar')

@section('user')
    <div class="container">

        <a href="{{ url('/') }}" type="button" class="btn btn-secondary">Back</a>
        <form action="{{ route('placeorder') }}" method="post" class="">
            @csrf
            <div class="row mt-5">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            @csrf
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkoutForm">
                                <div class="col-md-6 mt-2">
                                    <label for="firstName" class="form-label">First Name<span
                                            style="color:#ff0000">*</span></label>
                                    <input type="text" name="fname" class="form-control" id="firstName">
                                    <span id="fname_error" style="color:#ff0000"></span>
                                    @error('fname')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="lastName" class="form-label">Last Name<span
                                            style="color:#ff0000">*</span></label>
                                    <input type="text" name="lname" class="form-control" id="lastName">
                                    <span id="lname_error" style="color:#ff0000"></span>
                                    @error('lname')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="email" class="form-label">Email<span
                                            style="color:#ff0000">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email">
                                    <span id="email_error" style="color:#ff0000"></span>
                                    @error('email')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="phoneNumber" class="form-label">Phone Number<span
                                            style="color:#ff0000">*</span></label>
                                    <input type="text" name="phone_number" class="form-control" id="phoneNumber">
                                    <span id="pnumber_error" style="color:#ff0000"></span>
                                    @error('phone_number')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="address" class="form-label">Address<span
                                            style="color:#ff0000">*</span></label>
                                    <input type="text" name="address" class="form-control" id="address">
                                    <span id="address_error" style="color:#ff0000"></span>
                                    @error('address')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="city" class="form-label">City<span
                                            style="color:#ff0000">*</span></label>
                                    <input type="text" name="city" class="form-control" id="city">
                                    <span id="city_error" style="color:#ff0000"></span>
                                    @error('city')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="province" class="form-label">Province<span
                                            style="color:#ff0000">*</span></label>
                                    <input type="text" name="province" class="form-control" id="province">
                                    <span id="province_error" style="color:#ff0000"></span>
                                    @error('province')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="pincode" class="form-label">Pin Code<span
                                            style="color:#ff0000">*</span></label>
                                    <input type="text" name="pin_code" class="form-control" id="pincode">
                                    <input type="text" name="payment_mode" class="form-control" value="COD" hidden>
                                    <span id="pincode_error" style="color:#ff0000"></span>
                                    @error('pin_code')
                                        <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <hr>
                            @php
                                $total = 0;
                            @endphp
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr>
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->t_qty }}</td>
                                            <td>${{ $item->products->price }}</td>
                                        </tr>
                                        @php $total += $item->products->price * $item->t_qty; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <h6 class="mb-3">Total Price: ${{ $total }}
                                @if ($total < 1)
                                    <button type="submit" class="btn btn-success orderBtn float-end ms-3" disabled> Cash
                                        on
                                        Delivery</button>
                                    <button type="button" class="btn btn-info cardBtn float-end" disabled> Pay Using
                                        Stripe</button>


                            </h6>
                            @else
                            <button type="submit" class="btn btn-success orderBtn float-end ms-3" name="payment_status" value="unpaid"> Cash on
                                Delivery</button>
                            <button type="button" class="btn btn-info cardBtn float-end ms-3"> Pay Using Stripe</button>
                            {{-- <button type="button" class="btn btn-primary paypalBtn float-end ms-3"> Pay Using PayPal</button> --}}
                            <div class="col-3" id="paypal-button-container"></div>

                            </h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<script>
      $(document).ready(function() {
              paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                onClick: function(data, actions)  {
                var fname = $('#firstName').val();
                        var lname = $('#lastName').val();
                        var email = $('#email').val();
                        var phone_number = $('#phoneNumber').val();
                        var address = $('#address').val();
                        var city = $('#city').val();
                        var province = $('#province').val();
                        var pin_code = $('#pincode').val();
                    if (!fname) {
                            $fname_error = 'First Name is Required';
                            $('#fname_error').html('');
                            $('#fname_error').html($fname_error);
                            // alert($fname_error);
                        } else {
                            $fname_error = '';
                            $('#fname_error').html('');
                        }

                        if (!lname) {
                            $lname_error = 'Last Name is Required';
                            $('#lname_error').html('');
                            $('#lname_error').html($lname_error);
                            // alert($lname_error);
                        } else {
                            $lname_error = '';
                            $('#lname_error').html('');
                        }

                        if (!email) {
                            $email_error = 'Email is Required';
                            $('#email_error').html('');
                            $('#email_error').html($email_error);
                            // alert($email_error);
                        } else {
                            $email_error = '';
                            $('#email_error').html('');
                        }

                        if (!phone_number) {
                            $pnumber_error = 'Phone Number is Required';
                            $('#pnumber_error').html('');
                            $('#pnumber_error').html($pnumber_error);
                            // alert($pnumber_error);
                        } else {
                            $pnumber_error = '';
                            $('#pnumber_error').html('');
                        }

                        if (!address) {
                            $address_error = 'Address is Required';
                            $('#address_error').html('');
                            $('#address_error').html($address_error);
                            // alert($address_error);
                        } else {
                            $address_error = '';
                            $('#address_error').html('');
                        }

                        if (!city) {
                            $city_error = 'City is Required';
                            $('#city_error').html('');
                            $('#city_error').html($city_error);
                            // alert($city_error);
                        } else {
                            $city_error = '';
                            $('#city_error').html('');
                        }
                        if (!province) {
                            $province_error = 'Province is Required';
                            $('#province_error').html('');
                            $('#province_error').html($province_error);
                            // alert($province_error);
                        } else {
                            $province_error = '';
                            $('#province_error').html('');
                        }
                        if (!pin_code) {
                            $pincode_error = 'Pincode is Required';
                            $('#pincode_error').html('');
                            $('#pincode_error').html($pincode_error);
                            // alert($fname_error);
                        } else {
                            $pincode_error = '';
                            $('#pincode_error').html('');
                        }
                        if (!(fname != "" && lname != "" && email != "" && phone_number != "" &&
                            address != "" && city != "" && province != "" && pincode !=
                            "")) {
                          return false;  
                        }
                },
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: {{$total}}
                            }
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {
                        // Successful capture! For dev/demo purposes:
                        console.log('Capture result', orderData, JSON.stringify(orderData, null,
                            2));
                        const transaction = orderData.purchase_units[0].payments.captures[0];

                        var fname = $('#firstName').val();
                        var lname = $('#lastName').val();
                        var email = $('#email').val();
                        var phone_number = $('#phoneNumber').val();
                        var address = $('#address').val();
                        var city = $('#city').val();
                        var province = $('#province').val();
                        var pin_code = $('#pincode').val();

                        if (fname != "" && lname != "" && email != "" && phone_number != "" &&
                            address != "" && city != "" && province != "" && pincode !=
                            "") {

                            $.ajax({
                                type: "POST",
                                url: "{{ route('placeorder') }}",
                                data: {
                                    'fname': fname,
                                    'lname': lname,
                                    'email': email,
                                    'phone_number': phone_number,
                                    'address': address,
                                    'city': city,
                                    'province': province,
                                    'pin_code': pin_code,
                                    'payment_mode': 'PayPal',
                                    'payment_status': 'Paid'

                                },

                                success: function(response) {
                                    var url = '{{ route("myorders") }}';
                                    $(location).prop('href', url);
                                    alertify.set('notifier', 'position', 'top-right');
                                alertify.warning('Payment Successful');
                                }
                            });
                        } else {
                            return false;
                        }
                        // When ready to go live, remove the alert and show a success message within this page. For example:
                        // const element = document.getElementById('paypal-button-container');
                        // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                        // Or go to another URL:  actions.redirect('thank_you.html');
                    });
                }
            }).render('#paypal-button-container');
        });
</script>
@endsection

