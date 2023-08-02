function convertToRupiah(angka) {
    var rupiah = "";
    var angkarev = angka.toString().split("").reverse().join("");
    for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ".";
    return (
        "Rp" +
        rupiah
            .split("", rupiah.length - 1)
            .reverse()
            .join("")
    );
}

function convertToInt(rupiah) {
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ""), 10);
}

(function ($) {
    $.fn.inputFilter = function (callback, errMsg) {
        return this.on(
            "input keydown keyup mousedown mouseup select contextmenu drop focusout",
            function (e) {
                if (callback(this.value)) {
                    // Accepted value
                    if (
                        ["keydown", "mousedown", "focusout"].indexOf(e.type) >=
                        0
                    ) {
                        $(this).removeClass("input-error");
                        this.setCustomValidity("");
                    }
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    // Rejected value - restore the previous one
                    $(this).addClass("input-error");
                    this.setCustomValidity(errMsg);
                    this.reportValidity();
                    this.value = this.oldValue;
                    this.setSelectionRange(
                        this.oldSelectionStart,
                        this.oldSelectionEnd
                    );
                } else {
                    // Rejected value - nothing to restore
                    this.value = "";
                }
            }
        );
    };
})(jQuery);

function retnum(str) {
    var num = str.replace(/[^0-9]/g, "");
    return parseInt(num, 10);
}

function getCart() {
    $.ajax({
        type: "get",
        url: "/cart/render",
        dataType: "json",
        success: function (response) {
            $(".cart-render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

$(document).ready(function () {
    localStorage.clear();
    getCart();

    $("body").on("click", ".btn-remove-item", function () {
        var id = $(this).data("id");
        Swal.fire({
            title: "Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "/cart/remove/" + id,
                    type: "GET",
                    success: function (result) {
                        Swal.fire(result.title, result.message, result.status);
                        getCart();
                        $("body").find(".item-total").text(result.cartTotal);
                    },
                });
            }
        });
    });
});
