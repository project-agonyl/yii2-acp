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
        message: "This will replace current SHUE, SKILLS and WEAR. Are you sure?",
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

$('#char-grid-pjax').on('click', '.char-take-quest', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var warnUrl = $(this).data('warn-url');
    var content = '<center><div class="row"><div class="col-sm-3"><label class="control-label">Quest Type: ' +
        '</label></div><div class="col-sm-5"><select id="quest-type" class="col-sm-4 form-control">';
    content += '<option value="1">Letter Quest</option>';
    content += '<option value="2">Daily Quest</option>';
    content += '</select></div></div><br>This will replace your current QUEST</center>';
    bootbox.confirm({
        message: content,
        buttons: {
            confirm: {
                label: 'Take Quest',
                className: 'btn-success'
            },
            cancel: {
                label: 'Cancel',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                var type = $('#quest-type').val();
                doJsonGetRequest(warnUrl + '&type=' + type, function (data) {
                    bootbox.confirm({
                        message: data.msg,
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
                                doJsonPostRequest(url, {type: type}, function (data) {
                                    bootbox.alert(data.msg);
                                });
                            }
                        }
                    });
                });
            }
        }
    });
});

$('#char-grid-pjax').on('click', '.char-reset-stats', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var content = '<center><div class="row"><div class="col-sm-3"><label class="control-label">Currency Type: ' +
        '</label></div><div class="col-sm-5"><select id="currency-type" class="col-sm-4 form-control">';
    content += '<option value="coin">Flamez Coins</option>';
    content += '<option value="cash">Flamez Cash</option>';
    content += '</select></div></div><br>Please clear your WEAR before reset</center>';
    bootbox.confirm({
        message: content,
        buttons: {
            confirm: {
                label: 'Reset Stats',
                className: 'btn-success'
            },
            cancel: {
                label: 'Cancel',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                var type = $('#currency-type').val();
                doJsonPostRequest(url, {type: type}, function (data) {
                    bootbox.alert(data.msg);
                });
            }
        }
    });
});

$('#char-grid-pjax').on('click', '.char-submit-item', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    var content = '<center><div class="row"><div class="col-sm-3"><label class="control-label">Currency Type: ' +
        '</label></div><div class="col-sm-5"><select id="submit-type" class="col-sm-4 form-control">';
    content += '<option value="1">Submit Pumpkins</option>';
    content += '</select></div></div><br>Please keep boxes of 100 items in your inventory to submit</center>';
    bootbox.confirm({
        message: content,
        buttons: {
            confirm: {
                label: 'Submit',
                className: 'btn-success'
            },
            cancel: {
                label: 'Cancel',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                var type = $('#submit-type').val();
                doJsonPostRequest(url, {type: type}, function (data) {
                    bootbox.alert(data.msg);
                });
            }
        }
    });
});

$('#char-grid-pjax').on('click', '.char-submit-daily-quest', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    bootbox.confirm({
        message: 'This will submit the daily quest and clear your quest status. Are you sure?',
        buttons: {
            confirm: {
                label: 'Submit Quest',
                className: 'btn-success'
            },
            cancel: {
                label: 'Cancel',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                doJsonPostRequest(url, {type: 2}, function (data) {
                    bootbox.alert(data.msg);
                });
            }
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

$('.buy-btn').click(function (e) {
    e.preventDefault();
    var me = this;
    var $btn = $(this).button('loading');
    doJsonGetRequest($(me).data('purl'), function (data) {
        if (data.status === 'ok') {
            doJsonGetRequest($(me).data('curl'), function (data) {
                if (data.status === 'ok') {
                    var content = '<center><div class="row"><div class="col-sm-3"><label class="control-label">Deliver To: ' +
                        '</label></div><div class="col-sm-5"><select id="deliver-char" class="col-sm-4 form-control">';
                    for (var i = 0; i < data.characters.length; i++) {
                        content += '<option value="' + data.characters[i] + '">' + data.characters[i] + '</option>';
                    }
                    content += '</select></div></div></center>';
                    bootbox.confirm({
                        message: content,
                        buttons: {
                            confirm: {
                                label: 'Deliver',
                                className: 'btn-success'
                            },
                            cancel: {
                                label: 'Cancel',
                                className: 'btn-danger'
                            }
                        },
                        callback: function (result) {
                            if (result) {
                                var character = $('#deliver-char').val();
                                if (character !== null && character !== '') {
                                    doJsonPostRequest($(me).data('burl'), {character: character}, function (data) {
                                        $btn.button('reset');
                                        bootbox.alert(data.msg);
                                        $.pjax.reload({container: '#cart-grid-pjax'});
                                        setTimeout(function(){
                                            $.pjax.reload({container: '#balance-pjax'});
                                        }, 3000);
                                    });
                                } else {
                                    $btn.button('reset');
                                    bootbox.alert('Please choose a character to deliver items!');
                                }
                            } else {
                                $btn.button('reset');
                            }
                        }
                    });
                } else {
                    $btn.button('reset');
                    bootbox.alert(data.msg);
                }
            });
        } else {
            $btn.button('reset');
            bootbox.alert(data.msg);
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