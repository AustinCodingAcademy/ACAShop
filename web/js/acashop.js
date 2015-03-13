$(document).ready(function(){

    // Bind to the continue shopping button
    $("#btn-continue-shopping").click(function(){
       window.location.href = '/products';
    });

    // bind to the checkout button
    $("#btn-checkout").click(function(){
        window.location.href = '/process_order';
    });

    $("#btn-billing").click(function(){

        window.location.href = '/billing';

    });


    // make the billing form button submit the form
    $('#btn-process-order').click(function(){

        $("#billing-form").submit();
    });
});