// Initialize tooltip
$(function(){
    $('body').tooltip({ selector: '[data-toggle="tooltip"]' });
});

$('#add-item-btn').click(function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var item = $('#item').val();
    if (item === null || item === '') {
        bootbox.alert('Please choose an item to add!');
    } else {
        doJsonPostRequest(url, {item: item, quantity: 1}, function (data) {
            if (data.status !== 'ok') {
                bootbox.alert(data.msg);
            }
            $.pjax.reload({container: '#bundle-grid-pjax'});
        });
    }
});

$('#bundle-grid-pjax').on('click', '.incr-item', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var item = $(this).data('item');
    doJsonPostRequest(url, {item: item, quantity: 1}, function (data) {
        if (data.status !== 'ok') {
            bootbox.alert(data.msg);
        }
        $.pjax.reload({container: '#bundle-grid-pjax'});
    });
});

$('#bundle-grid-pjax').on('click', '.decr-item', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var item = $(this).data('item');
    doJsonPostRequest(url, {item: item, quantity: 1}, function (data) {
        if (data.status !== 'ok') {
            bootbox.alert(data.msg);
        }
        $.pjax.reload({container: '#bundle-grid-pjax'});
    });
});

$('#bundle-grid-pjax').on('click', '.rem-item', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var item = $(this).data('item');
    bootbox.confirm({
        message: "Are you sure you want to remove the item from bundle?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                doJsonPostRequest(url, {item: item, quantity: 100}, function (data) {
                    if (data.status !== 'ok') {
                        bootbox.alert(data.msg);
                    }
                    $.pjax.reload({container: '#bundle-grid-pjax'});
                });
            }
        }
    });
});

function doJsonPostRequest(url, data, callback) {
    if (!data['_csrf']) {
        data['_csrf'] = yii.getCsrfToken();
    }
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data,
        success: function (data) {
            callback(data);
        },
        error: function (xhr) {
            bootbox.alert(xhr.responseText);
        }
    });
}

function doJsonGetRequest(url, callback) {
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (data) {
            callback(data);
        },
        error: function (xhr) {
            bootbox.alert(xhr.responseText);
        }
    });
}