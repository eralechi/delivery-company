$(function(){
    function submitDeliveryForm(form, data) {

        form.find('#region-arrival-date').html(' - ');

        $.post("/assets/scripts/delivery-actions.php", data,
            function (data, textStatus, jqXHR) {
                if (data.error) {
                    form.find('.alert-danger').text(data.error).show();
                    form.find('.alert-success').hide();
                }
                if (data.success) {
                    form.find('.alert-success').text(data.success).show();
                    form.find('.alert-danger').hide();
                    form[0].reset();
                }
                if (data.region_arrival_date) {
                    form.find('.alert').hide();
                    form.find('#region-arrival-date').text(data.region_arrival_date).show();
                }
                console.log(data);
            },
            "json"
        );
    }

    $('#date-selector').on('change', function () {
        var form = $(this).closest('form');
        var data = form.serializeArray();
        if (!form.find('#date-selector').val()) {
           return;
        }
        data.push({name:'action', value:'region-arrival-date'});
        submitDeliveryForm(form, data);
    });

    $('#add-delivery-modal form').on('submit', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var data = form.serializeArray();
        data.push({name:'action', value:'create-delivery'});
        submitDeliveryForm(form, data);
    });
});