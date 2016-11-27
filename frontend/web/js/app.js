// Initialize tooltip
$(function(){
    $('body').tooltip({ selector: '[data-toggle="tooltip"]' });
});

$('#char-grid-pjax').on('click', '.char-offline-tp', function (e){
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

$('#char-grid-pjax').on('click', '.char-view', function (e){
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

$('#char-grid-pjax').on('click', '.char-gift', function (e){
    e.preventDefault();
    var url = $(this).data('url');
    bootbox.confirm({
        message: "This will replace current WEAR, SET as well as SKILLS. Are you sure?",
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
