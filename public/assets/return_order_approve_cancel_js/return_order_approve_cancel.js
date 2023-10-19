
// Approve Return Order Section Start JS
$(document).on('click', '#approve', function(e) {
    e.preventDefault();
    let url = $(this).attr("href");
    Swal.fire({
        title: 'Are you sure Approve?',
        text: "Once Approve, You will not be able to Pending again",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0ff769',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Yes, Approve!',
        cancelButtonText: "No, cancel please!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Approve!", "Approve Changes", "success");
        }
    });
});
// Approve Return Order Section End JS



// Cancel Return Order Section Start JS
$(document).on('click', '#cancel', function(e) {
    e.preventDefault();
    let url = $(this).attr("href");
    Swal.fire({
        title: 'Are you sure Cancel?',
        text: "Once Cancel, You will not be able to Pending again",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0ff769',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Yes, Cancel!',
        cancelButtonText: "No, cancel please!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Cancel!", "Cancel Changes", "success");
        }
    });
});
// Cancel Return Order Section End JS