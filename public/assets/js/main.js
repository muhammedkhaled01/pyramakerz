$(document).ready(function () {
    $(".dltBtn").click(function (e) {
        var form = $(this).closest("form");
        var dataID = $(this).data("id");
        // alert(dataID);
        e.preventDefault();
        swal({
            title: "Are you sure",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                swal("Your data is safe!");
            }
        });
    });
});
