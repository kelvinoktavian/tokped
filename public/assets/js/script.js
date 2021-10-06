// Image preview: https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded
var loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById("output");
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

// Sweet Alert 2
// Success / message alert
const swalSuccess = $(".swal-success").data("swal");
if (swalSuccess) {
    Swal.fire({
        icon: "success",
        title: swalSuccess,
    });
}

// Confirmation alert logout
$(document).on("click", ".logout", function (e) {
    // hentikan aksi default
    e.preventDefault();
    const href = $(this).attr("href");

    Swal.fire({
        title: "Are you sure want to log out?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Logout",
    }).then((result) => {
        if (result.isConfirmed) {
            // kalau berhasil, redirect ke attribut href yang ada di button
            document.location.href = href;
        }
    });
});

// $(".show_confirm").on("click", function (e) {
//     e.preventDefault();
//     let id = $(this).data("id");

//     Swal.fire({
//         title: "Are you sure?",
//         text: "You won't be able to revert this!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, delete it!",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $("#delete-form").submit();
//         }
//     });
// });

// Custom File Input
$(function () {
    bsCustomFileInput.init();
});

// Data Tables
$(function () {
    $("#example1")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        })
        .buttons()
        .container()
        .appendTo("#example1_wrapper .col-md-6:eq(0)");
    $("#example2").DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
    });
});

$(".product-image-thumb").on("click", function () {
    var $image_element = $(this).find("img");
    $(".product-image").prop("src", $image_element.attr("src"));
    $(".product-image-thumb.active").removeClass("active");
    $(this).addClass("active");
});

// $("#search").on("keyup", function () {
//     $value = $(this).val();
//     $.ajax({
//         type: "get",
//         url: "{{URL::to('search')}}",
//         data: { search: $value },
//         success: function (data) {
//             $("tbody").html(data);
//         },
//     });
// });

$(".alert")
    .fadeTo(2000, 500)
    .slideUp(500, function () {
        $(".alert").slideUp(500);
    });

$(document).ready(function () {
    $(".ckeditor").ckeditor();
});

// address ajax (province & city)
$('select[name="province_id"]').on("change", function () {
    var cityId = $(this).val();
    if (cityId) {
        $.ajax({
            url: "/getCity/ajax/" + cityId,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="city_id"]').empty();
                $.each(data, function (key, value) {
                    $('select[name="city_id"]').append(
                        '<option value="' + key + '">' + value + "</option>"
                    );
                });
            },
        });
    } else {
        $('select[name="city_id"]').empty();
    }
});

$('select[name="city_id"]').on("change", function () {
    var cityId = $(this).val();
    if (cityId) {
        $.ajax({
            url: "/getCity/ajax2/" + cityId,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $("#postal_code").attr("value", data);
            },
        });
    } else {
        $("input[type=text].postal_code").empty();
    }
});

$(function () {
    $(".datepicker").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
    });
});

function time() {
    const date = new Date();
    document.getElementById("time").innerHTML = date;
}
time();
window.setInterval(time, 1000);

function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
