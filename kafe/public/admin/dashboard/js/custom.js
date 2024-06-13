window.addEventListener("DOMContentLoaded", (event) => {
    const datatablesSimple = document.getElementById("datatablesSimple");
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});

const username = document.querySelector("#username");
if (username) {
    const name = document.querySelector("#name");
    name.addEventListener("change", function () {
        fetch("/dashboard/users/createUsername?name=" + name.value)
            .then((response) => response.json())
            .then((data) => (username.value = data.username));
    });
}

$(".addLevel").on("click", function () {
    $("#levelModalLabel").html("Level Baru");
    $("input[name=_method]").val("POST");
    $(".modal form").prop("action", "/dashboard/levels");
    $(".modal-footer button[type=submit]").html("Simpan");
    $("#id").val("");
    $("#name").val("");
});

$(document).on("click", ".editLevel", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#levelModalLabel").html("Perbarui Level");
    $(".modal form").prop("action", "/dashboard/levels/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    $.ajax({
        url: "/dashboard/levels/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            $("#id").val(response.id);
            $("#name").val(response.name);
        },
    });
});

$(".addCategory").on("click", function () {
    $("#categoryModalLabel").html("Kategori Baru");
    $("input[name=_method]").val("POST");
    $(".modal form").prop("action", "/dashboard/categories");
    $(".modal-footer button[type=submit]").html("Simpan");
    $("#id").val("");
    $("#name").val("");
});



$(".addstatusCategory").on("click", function () {
    $("#categorystatusModalLabel").html("Kategori Baru");
    $("input[name=_method]").val("POST");
    $(".modal form").prop("action", "/dashboard/categories/status");
    $(".modal-footer button[type=submit]").html("Simpan");
    $("#id").val("");
    $("#name").val("");
});


$(".addstatusorders").on("click", function () {
    $("#statusordersModalLabel").html("Status Order Baru");
    $("input[name=_method]").val("POST");
    $(".modal form").prop("action", "/dashboard/statusorders");
    $(".modal-footer button[type=submit]").html("Simpan");
    $("#id").val("");
    $("#nama").val("");
});


$(document).on("click", ".editstatusorders", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#statusordersModalLabel").html("Perbarui Status");
    $(".modal form").prop("action", "/dashboard/statusorders/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    console.log(id);
    $.ajax({
        url: "/dashboard/statusorders/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#id").val(response.id);
            $("#nama").val(response.nama);
        },
    });
});


$(document).on("click", ".editorderitems", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#orderitemsModalLabel").html("Perbarui Qty");
    $(".modal form").prop("action", "/dashboard/orderitems/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    console.log(id);
    $.ajax({
        url: "/dashboard/orderitems/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#id").val(response.id);
            $("#qty").val(response.qty);
        },
    });
});

$(".addstatusconsultations").on("click", function () {
    $("#statusconsultationsModalLabel").html("Status Konsultasi Baru");
    $("input[name=_method]").val("POST");
    $(".modal form").prop("action", "/dashboard/statusconsultations");
    $(".modal-footer button[type=submit]").html("Simpan");
    $("#id").val("");
    $("#nama").val("");
});

$(document).on("click", ".editstatusconsultations", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#statusconsultationsModalLabel").html("Perbarui Status");
    $(".modal form").prop("action", "/dashboard/statusconsultations/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    console.log(id);
    $.ajax({
        url: "/dashboard/statusconsultations/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#id").val(response.id);
            $("#nama").val(response.nama);
        },
    });
});



$(".addcategoryconsultations").on("click", function () {
    $("#categoryconsultationsModalLabel").html("Kategori Konsultasi Baru");
    $("input[name=_method]").val("POST");
    $(".modal form").prop("action", "/dashboard/categoryconsultations");
    $(".modal-footer button[type=submit]").html("Simpan");
    $("#id").val("");
    $("#nama").val("");
});

$(document).on("click", ".editcategoryconsultations", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#statusconsultationsModalLabel").html("Perbarui Kategori");
    $(".modal form").prop("action", "/dashboard/categoryconsultations/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    console.log(id);
    $.ajax({
        url: "/dashboard/categoryconsultations/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#id").val(response.id);
            $("#nama").val(response.nama);
        },
    });
});

$(".addCategorivideo").on("click", function () {
    $("#categorivideoModalLabel").html("Kategori Video Baru");
    $("input[name=_method]").val("POST");
    $(".modal form").prop("action", "/dashboard/categorivideos");
    $(".modal-footer button[type=submit]").html("Simpan");
    $("#id").val("");
    $("#name").val("");
});

$(".addCategoriposter").on("click", function () {
    $("#categoriposterModalLabel").html("Kategori Poster Baru");
    $("input[name=_method]").val("POST");
    $(".modal form").prop("action", "/dashboard/categoriposters");
    $(".modal-footer button[type=submit]").html("Simpan");
    $("#id").val("");
    $("#name").val("");
});

$(document).on("click", ".editCategory", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#categoryModalLabel").html("Perbarui Kategori");
    $(".modal form").prop("action", "/dashboard/categories/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    $.ajax({
        url: "/dashboard/categories/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {

            $("#id").val(response.id);
            $("#nama").val(response.nama);
        },
    });
});



$(document).on("click", ".editstatusCategory", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#categorystatusModalLabel").html("Perbarui Kategori");
    $(".modal form").prop("action", "/dashboard/categories/status/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    console.log(id);
    $.ajax({
        url: "/dashboard/categories/status/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#id").val(response.id);
            $("#name").val(response.name);
        },
    });
});




$(document).on("click", ".editCategorivideo", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#categorivideoModalLabel").html("Perbarui Kategori Video");
    $(".modal form").prop("action", "/dashboard/categorivideos/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    $.ajax({
        url: "/dashboard/categorivideos/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            $("#id").val(response.id);
            $("#name").val(response.name);
        },
    });
});

$(document).on("click", ".editCategoriposter", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#categoriposterModalLabel").html("Perbarui Kategori Poster");
    $(".modal form").prop("action", "/dashboard/categoriposters/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    $.ajax({
        url: "/dashboard/categoriposters/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            $("#id").val(response.id);
            $("#name").val(response.name);
        },
    });
});

$(".addTag").on("click", function () {
    $("#tagModalLabel").html("Tag Baru");
    $("input[name=_method]").val("POST");
    $(".modal form").prop("action", "/dashboard/tags");
    $(".modal-footer button[type=submit]").html("Simpan");
    $("#id").val("");
    $("#name").val("");
});

$(document).on("click", ".editTag", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#tagModalLabel").html("Perbarui Tag");
    $(".modal form").prop("action", "/dashboard/tags/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    $.ajax({
        url: "/dashboard/tags/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            $("#id").val(response.id);
            $("#name").val(response.name);
        },
    });
});

$(".addMenu").on("click", function () {
    $("#menuModalLabel").html("Menu Baru");
    $("input[name=_method]").val("POST");
    $(".modal form").prop("action", "/dashboard/menus");
    $(".modal-footer button[type=submit]").html("Simpan");
    $("#id").val("");
    $("#name").val("");
    $("#link").val("");
    $('#child option[value=""]').prop("selected", true);
    $("#sort").val("");
});

$(document).on("click", ".editMenu", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#menuModalLabel").html("Perbarui Menu");
    $(".modal form").prop("action", "/dashboard/menus/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    $.ajax({
        url: "/dashboard/menus/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            const child = response.child ? response.child : "";
            $("#id").val(response.id);
            $("#name").val(response.name);
            $("#link").val(response.link);
            $('#child option[value="' + child + '"]').prop("selected", true);
            $("#sort").val(response.sort);
        },
    });
});






$(document).ready(function () {
    // $('select').attr('data-live-search', 'true');
    // $('select').selectpicker();

    $('#customTable').DataTable({
        "lengthChange": false,
        "paging": false,
        "bInfo": false
    });
    $('#customTable2').DataTable({
        "lengthChange": false,
        "paging": false,
        "bInfo": false
    });
    $('#tableStandar').DataTable();
});

function previewImage(fieldId, previewClass) {
    const image = document.querySelector('#' + fieldId);
    const imgPreview = document.querySelector('.' + previewClass);

    imgPreview.style.display = 'block';
    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload = function (img) {
        imgPreview.src = img.target.result;
    }
}

function formatStrNum(inputId) {
    return $('#' + inputId).val() ? $('#' + inputId).val(numFormat($('#' + inputId).val().replace('.', ','))) :
        '';
}

function strToNum(inputId) {
    const result = numFormat($('#' + inputId).val());
    return $('#' + inputId).val(result);
}

function numFormat(bilangan, prefix) {
    var number_string = bilangan.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function formatRupiah(angka) {
    if (angka) {
        var number_string = angka.toString().match(/[0-9,]+/g).join([]).toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        if (parseInt(angka) < 0) {
            return '-' + rupiah;
        } else {
            return rupiah;
        }
    } else {
        return '';
    }
}

function addOption(inputId, val, text) {
    $('#' + inputId).append($('<option>').val(val).text(text));
}
























$(document).on("click", ".editSection", function () {
    const id = $(this).data("id");
    $("input[name=_method]").val("PUT");
    $("#sectionModalLabel").html("Perbarui Section");
    $(".modal form").prop("action", "/dashboard/sections/" + id);
    $(".modal-footer button[type=submit]").html("Perbarui");
    $.ajax({
        url: "/dashboard/sections/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            const status = response.status ? response.status : "0";
            $("#id").val(response.id);
            $("#name").val(response.name);
            $('#status option[value="' + status + '"]').prop(
                "selected",
                "selected"
            );
        },
    });
});

$(document).on("click", ".replyComment", function () {
    const id = $(this).data("id");
    $.ajax({
        url: "/dashboard/comments/" + id,
        method: "get",
        dataType: "json",
        success: function (response) {
            $("#reply_id").val(response.comment.id);
            $("#post_id").val(response.comment.post_id);
            $("#name").val(response.comment.name);
            $("#email").val(response.comment.email);
            $("#comment1").val(response.comment.comment);
            $("#comment").val(response.reply ? response.reply.comment : "");
        },
    });
});

function previewImage(fieldId, previewClass) {
    const image = document.querySelector("#" + fieldId);
    const imgPreview = document.querySelector("." + previewClass);

    imgPreview.style.display = "block";
    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload = function (img) {
        imgPreview.src = img.target.result;
    };
}

$(document).ready(function () {
    $("#customTable").DataTable({
        lengthChange: false,
        paging: false,
        bInfo: false,
    });

    $("#tableStandar").DataTable();
});
