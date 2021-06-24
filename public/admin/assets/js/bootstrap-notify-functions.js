function callBootstrapNotify(type, message, title,) {
    let icon = '';

    if (type === 'success') {
        icon = 'fas fa-check-circle';
    } else if (type === 'danger') {
        icon = 'fas fa-exclamation-circle';
    } else if (type === 'warning') {
        icon = 'fas fa-times-circle';
    } else if (type === 'info') {
        icon = 'fas fa-info-circle';
    }

    $.notify({
        icon: icon,
        title: title,
        message: message,
    }, {
        type: type, // success, danger, warning, info, primary, brand
        allow_dismiss: true,
        //newest_on_top: $('#kt_notify_top').prop('checked'),
        mouse_over:  true,
        showProgressbar:  null,
        spacing: 10,
        timer: 2000,
        placement: {
            from: 'bottom',
            align: 'right'
        },
        offset: {
            x: 30,
            y: 75
        },
        delay: 1000,
        z_index: 10000,
        animate: {
            enter: 'animated ' + 'bounceInRight',
            exit: 'animated ' + 'fadeOutRight'
        }
    });

}
