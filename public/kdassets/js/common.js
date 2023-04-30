function generate_alert(title,msg,icon='success') {
    Swal.fire({
        title: title,
        text: msg,
        icon: icon,
        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
        buttonsStyling: !1,
        showCloseButton: !0
    })
}

function generate_confirm_alert(callback) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
        confirmButtonText: "Yes, delete it!",
        showCancelButton: !0,
        cancelButtonClass: "btn btn-danger w-xs mt-2",
        buttonsStyling: !1,
        showCloseButton: !0
    }).then(function(t) {
        callback(t.value);
    })
}
