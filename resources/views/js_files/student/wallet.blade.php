<script>

function addBalance()
{
    $.ajax({
        url: "{{route('check.default.payment')}}",
        type:"GET",
        success:function(data){
            if(data.success){
                $("#pmnt").html(data.success)
                $('#checkbox1, #checkbox2').attr('disabled','true')
                $('#paymntbtn').attr('type','button')
            }
        },
    });

    $("#payModel").modal('show');
}

    function skrill(amount) {
        var url  =  "{{url('student/skrillPayment')}}"+"/"+amount;
        var skrill = window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=20,left=500,width=500,height=650");
    }


    $(document).ready(function(){
        $("#amount").change(function(){

            amount = $(this).val();
            if(amount != null){
                $("#paypal-button-container").html('')

                //show div block on enter payment
                $("#paymntbtn").click(function(){
                    $("#paymentBlock").css('display','block');
                    $("#paymntbtn").css('display','none');
                });

                $("#skrillPayment").click(function(){
                    skrill(amount);
                });

                paypal.Button.render({
                    // selection for sandbox or production
                    env: 'sandbox', // sandbox | production
                    // PayPal Client IDs, these are the example defaults - replace with your own
                    client: {
                        sandbox: "{{ Config::get('paypal')['sandbox']['client_id'] }}",
                        production: '<insert production client id>'
                    },
                    // Show the buyer a 'Pay Now' button in the checkout flow
                    commit: true,
                    // payment() is called when the button is clicked
                    payment: function(data, actions) {
                        // Make a call to the REST api to create the payment
                        return actions.payment.create({
                            transactions: [{
                                amount: {
                                    total: amount,
                                    currency: 'USD'
                                },
                                description: 'Deposit Money',
                                payment_options: {
                                    allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
                                },
                            }]
                        });
                        // return actions.payment.create({
                        //     payment: {
                        //         transactions: [{
                        //             // This is your cart totals, shipping, tax etc, just remove items you dont need
                        //             amount: {
                        //                 total: '30.11',
                        //                 currency: 'USD',
                        //                 details: {
                        //                     subtotal: '30.00',
                        //                     tax: '0.07',
                        //                     shipping: '0.03',
                        //                     handling_fee: '1.00',
                        //                     shipping_discount: '-1.00',
                        //                     insurance: '0.01'
                        //                 }
                        //             },
                        //             description: 'The payment transaction description.',
                        //             custom: 'EBAY_EMS_90048630024435',
                        //             invoice_number: '48787589673',
                        //             payment_options: {
                        //                 allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
                        //             },
                        //             soft_descriptor: 'ECHI5786786',
                        //             item_list: {
                        //                 // Loop through your cart here, must add up to sub total set above
                        //                 items: [{
                        //                         name: 'hat',
                        //                         description: 'Brown hat.',
                        //                         quantity: '5',
                        //                         price: '3',
                        //                         tax: '0.01',
                        //                         sku: '1',
                        //                         currency: 'USD'
                        //                     },
                        //                 ],
                        //                 shipping_address: {
                        //                     recipient_name: '{{Auth::user()->first_name}} {{Auth::user()->last_name}}',
                        //                     line1: '{{Auth::user()->address}}',
                        //                     city: '{{Auth::user()->city}}',
                        //                     country_code: '{{Auth::user()->country_short}}',
                        //                 }

                        //             }

                        //         }]
                        //     }
                        // });
                    },
                    onAuthorize: function(data, actions) {
                        // Make a call to the REST api to execute the payment
                        return actions.payment.execute().then(function() {
                            // If the transaction is successful on Paypal, you can then Post to a script to run actions on your site like emailing the user etc
                            return actions.request.post("{{route('student.deposit')}}", {
                                _token: "{{csrf_token()}}",
                                paymentID: data.paymentID,
                                payerID: data.payerID,
                                amount: amount,
                                method: 'paypal',
                            }).then(function(response) {
                                if(response.status == 200) {
                                    toastr.success(response.message,{
                                        position: 'top-end',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    location.reload();

                                } else if(response.status == 400) {
                                        toastr.error(response.message,{
                                        position: 'top-end',
                                        icon: 'error',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });

                                }

                            });
                        });

                    },
                    onCancel: function(data, actions) {
                        // Show an alert if user cancels
                        window.alert('Canceled by user');
                    },
                    onError: function(err) {
                        // Show an alert with error
                        window.alert('Error: ' + err);
                    },
                    style: {
                        // layout:  'vertical',
                        size:    'small',
                        color:   'white',
                        shape:   'rect',
                        label:   'paypal',
                        tagline: 'false',
                        height:     45
                    }


                }, '#paypal-button-container');
            }
        });
    });



</script>
