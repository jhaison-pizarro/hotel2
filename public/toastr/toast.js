function toast_msg(msg, title , type)
{
    switch (type) {
        case 'success':
            toastr.success(msg, title, {
                "positionClass": "toast-top-center",
                "timeOut"      : 1200
            });
            break;
    
        case 'warning':
            toastr.warning(msg, title, {
                "positionClass": "toast-top-center",
                "timeOut"      : 1200
            });
            break;

        case 'info':
            toastr.info(msg, title, {
                "positionClass": "toast-top-center",
                "timeOut"      : 1200
            });
            break;

        case 'error':
            toastr.error(msg, title, {
                "positionClass": "toast-top-center",
                "timeOut"      : 1200
            });
            break;
    }
    
}
toast_msg();
