
$('document').ready(function () {


    $('body').on('click', '.get_data_by_form_submit', function (evt) {
        evt.preventDefault();
        $('.ajax-data').html('');
        var me = $(this),
            form = me.closest('form'),
            data = form.serialize(),
            url = form.attr('action');

        get_data(url, data);
    });

    $('body').on('change', '.get_data_by_change', function (evt) {
        $('.ajax-data').html('');
        var me = $(this),
            val = me.val(),
            name = me.data('name');
        url = me.data('href');
        //alert(val);
        get_data(url, data = { data: name + '-' + val });
    });


    $('body').on('click', '.custom_delete', function (evt) {
        evt.preventDefault();
        var me = $(this),
            token = me.data('token'),
            url = me.data('href');

        $.ajax({
            url: url,
            type: 'POST',
            data: { '_method': 'delete', '_token': token },
            success: function (response) {
                toastr.success(response);
                me.parents('tr').remove();

            },

            error: function (jqXhr, json, errorThorwn) {
                toastr.error("Somthings Wrong! try agin letter");
            }
        });
    });


    $('body').on('change', '.add_temp_record', function (evt) {
        evt.preventDefault();
        var me = $(this),
            form = me.closest('form'),
            data = form.serialize(),
            url = form.attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                toastr.success('Record Added');
            },

            error: function (jqXhr, json, errorThorwn) {
                toastr.error("Somthings Wrong! try agin letter");
            }
        });
    });




});


function get_data(url, data) {
    if (data) {
        $.get(url, data, function (res, textStatus, jqXHR) {
            if (res.errors) {
                toastr.error(res.errors);
            }
            $('.ajax-data').html(res);

        });
    }

}




