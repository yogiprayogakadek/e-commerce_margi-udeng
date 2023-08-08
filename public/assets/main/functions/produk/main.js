function getData() {
    $.ajax({
        type: "get",
        url: "/produk/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function tambah() {
    $.ajax({
        type: "get",
        url: "/produk/create",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

var rupiah = $("#harga");
function convertToRupiah(number, prefix) {
    var number_string = number.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        remaining = split[0].length % 3,
        rupiah = split[0].substr(0, remaining),
        thousand = split[0].substr(remaining).match(/\d{3}/gi);

    if (thousand) {
        separator = remaining ? "." : "";
        rupiah += separator + thousand.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

$(document).ready(function () {
    getData();

    $("body").on("click", "#kategori", function () {
        let kategori = $("select[name=kategori] option")
            .filter(":selected")
            .val();

        if (kategori != "") {
            $(".hidden-input").prop("hidden", false);
            return false;
        }
        $(".hidden-input").prop("hidden", true);
    });

    $("body").on("keyup", "#harga", function (e) {
        $("#harga").val(convertToRupiah($(this).val(), "Rp. "));
    });

    $("body").on("click", ".btn-add", function () {
        tambah();
    });

    $("body").on("click", ".btn-data", function () {
        getData();
    });

    // on save button
    $("body").on("click", ".btn-save", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let form = $("#formAdd")[0];
        let data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "/produk/store",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $(".btn-save").attr("disable", "disabled");
                $(".btn-save").html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function () {
                $(".btn-save").removeAttr("disable");
                $(".btn-save").html("Simpan");
            },
            success: function (response) {
                $("#formAdd").trigger("reset");
                $(".invalid-feedback").html("");
                Swal.fire(response.title, response.message, response.status);
                if (response.status == "success") {
                    getData();
                }
            },
            error: function (error) {
                let formName = [];
                let errorName = [];

                $.each($("#formAdd").serializeArray(), function (i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ""));
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(
                            error.responseJSON.errors,
                            function (key, value) {
                                errorName.push(key);
                                if ($("." + key).val() == "") {
                                    $("." + key).addClass("is-invalid");
                                    $(".error-" + key).html(value);
                                }
                            }
                        );
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1
                                ? $("." + field).removeClass("is-invalid")
                                : $("." + field).addClass("is-invalid");
                        });
                    }
                }
            },
        });
    });

    $("body").on("click", ".btn-edit", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "get",
            url: "/produk/edit/" + id,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    });

    // on update button
    $("body").on("click", ".btn-update", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let form = $("#formEdit")[0];
        let data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "/produk/update",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $(".btn-update").attr("disable", "disabled");
                $(".btn-update").html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function () {
                $(".btn-update").removeAttr("disable");
                $(".btn-update").html("Simpan");
            },
            success: function (response) {
                $("#formEdit").trigger("reset");
                $(".invalid-feedback").html("");
                Swal.fire(response.title, response.message, response.status);
                if (response.status == "success") {
                    getData();
                }
            },
            error: function (error) {
                console.log(error);
                let formName = [];
                let errorName = [];

                $.each($("#formEdit").serializeArray(), function (i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ""));
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(
                            error.responseJSON.errors,
                            function (key, value) {
                                errorName.push(key);
                                if ($("." + key).val() == "") {
                                    $("." + key).addClass("is-invalid");
                                    $(".error-" + key).html(value);
                                }
                            }
                        );
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1
                                ? $("." + field).removeClass("is-invalid")
                                : $("." + field).addClass("is-invalid");
                        });
                    }
                }
            },
        });
    });

    $("body").on("click", ".btn-print", function () {
        Swal.fire({
            title: "Cetak data produk?",
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
                    popTitle: "LaporanDataProduk",
                    popOrient: "landscape",
                };
                $.ajax({
                    type: "GET",
                    url: "/produk/print/",
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

    // DATA PRODUK
    function getDataProdukDetail(id_produk) {
        $.ajax({
            type: "get",
            url: "/produk/data/render/" + id_produk,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    }

    function tambahDataProdukDetail(id_produk) {
        $.ajax({
            type: "get",
            url: "/produk/data/create/" + id_produk,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    }

    $("body").on("click", ".btn-detail-data", function () {
        let id_produk = $(this).data("id");
        localStorage.setItem("id_produk", id_produk);
        getDataProdukDetail(id_produk);
    });

    $("body").on("click", ".btn-add-detail-produk", function () {
        tambahDataProdukDetail(localStorage.getItem("id_produk"));
    });

    $("body").on("click", ".btn-data-detail-produk", function () {
        getDataProdukDetail(localStorage.getItem("id_produk"));
    });

    $("body").on("change", ".size", function () {
        let value = $("select[name=size] option").filter(":selected").val();

        if (value == "") {
            $("#formAddDataProduk .hidden-input").prop("hidden", true);
            return false;
        }
        $("#formAddDataProduk .hidden-input").prop("hidden", false);
    });

    // on save button
    $("body").on("click", ".btn-save-detail-produk", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let form = $("#formAddDataProduk")[0];
        let data = new FormData(form);
        data.append("produk_id", localStorage.getItem("id_produk"));
        $.ajax({
            type: "POST",
            url: "/produk/data/store",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $(".btn-save-detail-produk").attr("disable", "disabled");
                $(".btn-save-detail-produk").html(
                    '<i class="fa fa-spin fa-spinner"></i>'
                );
            },
            complete: function () {
                $(".btn-save-detail-produk").removeAttr("disable");
                $(".btn-save-detail-produk").html("Simpan");
            },
            success: function (response) {
                Swal.fire(response.title, response.message, response.status);
                if (response.status == "success") {
                    $("#formAddDataProduk").trigger("reset");
                    $(".invalid-feedback").html("");
                    getDataProdukDetail(localStorage.getItem("id_produk"));
                }
            },
            error: function (error) {
                let formName = [];
                let errorName = [];

                $.each(
                    $("#formAddDataProduk").serializeArray(),
                    function (i, field) {
                        formName.push(field.name.replace(/\[|\]/g, ""));
                    }
                );
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(
                            error.responseJSON.errors,
                            function (key, value) {
                                errorName.push(key);
                                if ($("." + key).val() == "") {
                                    $("." + key).addClass("is-invalid");
                                    $(".error-" + key).html(value);
                                }
                            }
                        );
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1
                                ? $("." + field).removeClass("is-invalid")
                                : $("." + field).addClass("is-invalid");
                        });
                    }
                }
            },
        });
    });

    $("body").on("click", ".btn-edit-detail-produk", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let size = $(this).data("size");
        $.ajax({
            type: "POST",
            url: "/produk/data/edit",
            data: {
                size: size,
                produk_id: localStorage.getItem("id_produk"),
            },
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    });

    // on save button
    $("body").on("click", ".btn-update-detail-produk", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let form = $("#formEditDataProduk")[0];
        let data = new FormData(form);
        data.append("produk_id", localStorage.getItem("id_produk"));
        $.ajax({
            type: "POST",
            url: "/produk/data/update",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $(".btn-update-detail-produk").attr("disable", "disabled");
                $(".btn-update-detail-produk").html(
                    '<i class="fa fa-spin fa-spinner"></i>'
                );
            },
            complete: function () {
                $(".btn-update-detail-produk").removeAttr("disable");
                $(".btn-update-detail-produk").html("Simpan");
            },
            success: function (response) {
                Swal.fire(response.title, response.message, response.status);
                if (response.status == "success") {
                    $("#formEditDataProduk").trigger("reset");
                    $(".invalid-feedback").html("");
                    getDataProdukDetail(localStorage.getItem("id_produk"));
                }
            },
            error: function (error) {
                let formName = [];
                let errorName = [];

                $.each(
                    $("#formEditDataProduk").serializeArray(),
                    function (i, field) {
                        formName.push(field.name.replace(/\[|\]/g, ""));
                    }
                );
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(
                            error.responseJSON.errors,
                            function (key, value) {
                                errorName.push(key);
                                if ($("." + key).val() == "") {
                                    $("." + key).addClass("is-invalid");
                                    $(".error-" + key).html(value);
                                }
                            }
                        );
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1
                                ? $("." + field).removeClass("is-invalid")
                                : $("." + field).addClass("is-invalid");
                        });
                    }
                }
            },
        });
    });

    $("body").on("click", ".btn-delete-detail-produk", function () {
        let produk_id = localStorage.getItem("id_produk");
        let size = $(this).data("size");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        Swal.fire({
            title: "Hapus data ini?",
            text: "data tidak dapat dikembalikan!",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/produk/data/delete",
                    data: {
                        produk_id: produk_id,
                        size: size,
                    },
                    success: function (response) {
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        );
                        getDataProdukDetail(localStorage.getItem("id_produk"));
                    },
                });
            }
        });
    });
});
