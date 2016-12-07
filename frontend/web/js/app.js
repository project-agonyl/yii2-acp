// Initialize tooltip
$(function () {
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});
});

$('#char-grid-pjax').on('click', '.char-offline-tp', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    bootbox.confirm({
        message: "Your character wil be teleported to Temoz. Are you sure?",
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
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: {_csrf: yii.getCsrfToken()},
                    success: function (data) {
                        bootbox.alert(data.msg);
                    },
                    error: function (xhr) {
                        bootbox.alert(xhr.responseText);
                    }
                });
            }
        }
    });
});

$('#char-grid-pjax').on('click', '.char-view', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    $.ajax({
        url: url,
        success: function (data) {
            bootbox.alert({
                message: data,
                size: 'large'
            });
        },
        error: function (xhr) {
            bootbox.alert(xhr.responseText);
        }
    });
});

$('#char-grid-pjax').on('click', '.char-gift', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    bootbox.confirm({
        message: "This will replace current SHUE. Are you sure?",
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
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: {_csrf: yii.getCsrfToken()},
                    success: function (data) {
                        bootbox.alert(data.msg);
                    },
                    error: function (xhr) {
                        bootbox.alert(xhr.responseText);
                    }
                });
            }
        }
    });
});

$('#char-grid-pjax').on('click', '.char-rb', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var rbUrl = $(this).data('rb-url');
    $.ajax({
        url: url,
        success: function (data) {
            bootbox.confirm({
                message: data,
                buttons: {
                    confirm: {
                        label: 'Take Rebirth',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Cancel',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            url: rbUrl,
                            type: 'post',
                            dataType: 'json',
                            data: {_csrf: yii.getCsrfToken()},
                            success: function (data) {
                                bootbox.alert(data.msg);
                            },
                            error: function (xhr) {
                                bootbox.alert(xhr.responseText);
                            }
                        });
                    }
                }
            });
        },
        error: function (xhr) {
            bootbox.alert(xhr.responseText);
        }
    });
});

$('#eshop-pjax-container').on('click', '.add-to-cart-btn', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var item = $(this).data('key');
    doJsonPostRequest(url, {item: item, quantity: 1}, function (data) {
        bootbox.alert(data.msg);
    });
});

$('#cart-grid-pjax').on('click', '.incr-item', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var item = $(this).data('item');
    doJsonPostRequest(url, {item: item, quantity: 1}, function (data) {
        if (data.status !== 'ok') {
            bootbox.alert(data.msg);
        }
        $.pjax.reload({container: '#cart-grid-pjax'});
    });
});

$('#cart-grid-pjax').on('click', '.decr-item', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var item = $(this).data('item');
    doJsonPostRequest(url, {item: item, quantity: 1}, function (data) {
        if (data.status !== 'ok') {
            bootbox.alert(data.msg);
        }
        $.pjax.reload({container: '#cart-grid-pjax'});
    });
});

$('#cart-grid-pjax').on('click', '.rem-item', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var item = $(this).data('item');
    bootbox.confirm({
        message: "Are you sure you want to remove the item from cart?",
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
                    $.pjax.reload({container: '#cart-grid-pjax'});
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
    })
}