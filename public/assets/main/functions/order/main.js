function getData() {
    $.ajax({
        type: "get",
        url: "/order/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

$(document).ready(function () {
    getData();

    $("body").on("click", ".detail-order", function () {
        let order_id = $(this).data("id");

        $("#modal").modal("show");

        $("#tableDetail tbody").empty();
        $.get("/account/detail-order/" + order_id, function (result) {
            $.each(result.data, function (index, value) {
                let list =
                    "<tr>" +
                    "<td>" +
                    (index + 1) +
                    "</td>" +
                    "<td>" +
                    value.nama +
                    "</td>" +
                    "<td>" +
                    value.harga +
                    "</td>" +
                    "<td>" +
                    value.size +
                    "</td>" +
                    "<td>" +
                    value.kuantitas +
                    "</td>" +
                    '<td class="subtotal text-end">' +
                    value.subtotal +
                    "</td>" +
                    "</tr>";

                $("#tableDetail tbody").append(list);
            });
            $(".total").html(
                '<p class="text-end"><strong>' + result.total + "</strong></p>"
            );
        });
    });

    $("body").on("click", ".btn-print", function () {
        Swal.fire({
            title: "Cetak data order?",
            text: "Laporan akan dicetak",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, cetak!",
        }).then((result) => {
            if (result.value) {
                var mode = "iframe"; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close,
                    popTitle: "LaporanDataOrder",
                    // popOrient: "landscape",
                };
                $.ajax({
                    type: "GET",
                    url: "/order/print/",
                    dataType: "json",
                    success: function (response) {
                        document.title =
                            "E-Commerce Margi Udeng | Pakaian Adat Bali - Print" +
                            new Date().toJSON().slice(0, 10).replace(/-/g, "/");
                        $(response.data)
                            .find("div.printableArea")
                            .printArea(options);
                    },
                });
            }
        });
    });
});
