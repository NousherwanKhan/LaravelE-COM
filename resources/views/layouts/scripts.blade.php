<!DOCTYPE html>
<html lang="en">

<head>
    <title>Table</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
</head>

<body>

    @yield('navbar')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <!-- JavaScript -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD&intent=capture&enable-funding=venmo"
        data-sdk-integration-source="integrationbuilder"></script>

    <script>
        $(function() {
            var availableTags = [];

            $.ajax({
                type: "get",
                url: "{{ route('productlist') }}",
                success: function(response) {

                    starAutoComplete(response);
                }
            });

            function starAutoComplete(availableTags) {
                $("#search_product").autocomplete({
                    source: availableTags
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.cardBtn').click(function(e) {
                e.preventDefault();

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

                if (fname != "" && lname != "" && email != "" && phone_number != "" &&
                    address != "" && city != "" && province != "" && pincode !=
                    "") {

                    var data = {
                        'fname': fname,
                        'lname': lname,
                        'email': email,
                        'phone_number': phone_number,
                        'address': address,
                        'city': city,
                        'province': province,
                        'pin_code': pin_code,
                        'payment_mode': 'Stripe'
                    }
                    $.ajax({
                        method: "POST",
                        url: "{{ route('payment') }}",
                        data: data,
                        success: function(response) {
                            var url = "{{ route('stripepay', ':id') }}";
                            url = url.replace(':id', response.id);
                            if (data) {
                                var url = url;
                                $(location).attr('href', url);
                            }
                        }
                    });
                } else {
                    return false;
                }
            })

            loadcart();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loadcart() {

                $.ajax({
                    type: "get",
                    url: "{{ route('loadcart') }}",
                    success: function(response) {
                        // $('.cartCount').html(' ');
                        $('.cartCount').html(response.count);
                    }
                });

            }

            $('.addToCartBtn').click(function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.productData').find('.prod_id').val();
                // var $buyer_id = $(this).closest('.productData').find('.buyr_id').val()
                var t_qty = $(this).closest('.productData').find('.qty-input').val();
                // var _token = $("input[name='_token']").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('cartview') }}",
                    data: {
                        // _token:'_token',
                        'product_id': product_id,
                        // 'buyer_id' : buyer_id,
                        't_qty': t_qty
                    },


                    success: function(response) {
                        // console.log(response);
                        if (response.status == 400) {

                            alertify.alert('Alert Title', response.message)
                        } else if (response.status == 200) {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.warning(response.message);
                        } else if (response.status == 201) {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(response.message);
                        }


                        loadcart();

                    }
                });
            });

            $('.increment-btn').click(function(e) {
                e.preventDefault();
                let max = $(this).attr('max');
                var inc_value = $(this).closest('.productData').find('.qty-input').val()
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value < max) {
                    value++;
                    $(this).closest('.productData').find('.qty-input').val(value)
                }
            });

            $('.decrement-btn').click(function(e) {
                e.preventDefault();
                var dec_value = $(this).closest('.productData').find('.qty-input').val()
                var value = parseInt(dec_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $(this).closest('.productData').find('.qty-input').val(value)
                }
            });

            $('.delete_cart_item').click(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var product_id = $(this).closest('.productData').find('.product_id').val()
                $.ajax({
                    type: "POST",
                    url: "{{ route('deletecart') }}",
                    data: {
                        'product_id': product_id
                    },

                    success: function(response) {


                        if (response.status == 400) {

                            alertify.alert('Alert Title', response.message)

                        } else if (response.status == 201) {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(response.message);
                            window.location.reload()
                        }

                    }
                });
            });

            $('.changeQty').click(function(e) {
                e.preventDefault();
                var product_id = $(this).closest('.productData').find('.product_id').val()
                var t_qty = $(this).closest('.productData').find('.qty-input').val()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('updatecart') }}",
                    data: {
                        'product_id': product_id,
                        't_qty': t_qty,
                    },
                    // dataType: "dataType",
                    success: function(response) {

                        if (response.status == 400) {

                            alertify.alert('Alert Title', response.message)

                        } else if (response.status == 201) {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(response.message);
                            $(".card-footer").load(location.href + " .card-footer");
                        }
                    }
                });
            });

        });
    </script>

</body>

</html>

{{-- $.ajax({
    type: "post",
    url: "{{ route('stripe') }}",
    data: {
        'firstname':response.firstname,
        'lastname':response.lastname,
        'email':response.email,
        'phoneNumber':response.phoneNumber,
        'address':response.address,
        'city':response.city,
        'province':response.province,
        'pincode':response.pincode,
        'payment_mode':response.payment_mode,
        'tracking_no':response.tracking_no,
        'price':response.price
    },
    success: function(response) {



    }
}); --}}
