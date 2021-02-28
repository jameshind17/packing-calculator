$(function() {
    $('#calculator').submit(function(e) {
        e.preventDefault();
        $('.loader').show();
        $('.packing-results').remove();
        var protocol = window.location.protocol;
        var hostname = window.location.hostname;
        var qty = $('#order-quantity').val();

        $.ajax({
            url: protocol + '//' + hostname + '/packing-sizes/calculator',
            type: 'POST',
            headers: {'X-CSRF-Token': getCsrfToken()},
            data: {qty: qty},
            success: function(data) {
                $('.loader').hide();
                $('.form').append(data);
            }
        });
    });

    // get form csrf token to pass into AJAX call
    function getCsrfToken() {
        return $("[name='_csrfToken']").val();
    }
});
