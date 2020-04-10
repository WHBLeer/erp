/*!
 * ERP Management System Extension v1.0.0 (https://www.whongbin.cn/)
 * Copyright 2017-2020 HongBin Wang
 * Licensed under the GPL-2.0-or-later license
 */
init();
function init() {
    layer.config({
        extend: 'mystyle/style.css',
        skin: 'layer-ext-mystyle'
    });
    console.log("%c总有人山高路远为你而来 %c三里林","color:#fff;font-size:16px;background:#f40;","color:#fff;font-size:16px;background:#111;");
}
function info(msg) {
    layer.alert(msg, {icon: 1});
}
function success(msg) {
    layer.alert(msg, {icon: 6});
}
function error(msg) {
    layer.alert(msg, {icon: 5});
}
function notify(msg,stat) {
    switch (stat) {
        case '0':
            icon = '<i class="ion ion-md-checkmark-circle"></i> ';
            status = 'success';
            break;
        case '1':
            icon = '<i class="ion ion-md-close-circle"></i> ';
            status = 'warning';
            break;
        case '2':
            icon = '<i class="ion ion-md-help-circle"></i> ';
            status = 'danger';
            break;
        default:
            icon = '<i class="ion ion-md-information-circle"></i> ';
            status = '';
            break;
    }
    UIkit.notify(icon+msg, {status:status,timeout: 3000,pos : 'top-right'});
}