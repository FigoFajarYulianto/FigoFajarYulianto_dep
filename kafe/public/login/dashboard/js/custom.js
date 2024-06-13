window.addEventListener('DOMContentLoaded', event => {
    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});

const username = document.querySelector('#username');
if (username) {
    const name = document.querySelector('#name');
    name.addEventListener('change', function () {
        fetch('/dashboard/users/createUsername?name=' + name.value)
            .then(response => response.json())
            .then(data => username.value = data.username)
    });
}

$('.addLevel').on('click', function () {
    $('#levelModalLabel').html('Level Baru');
    $('input[name=_method]').val('POST');
    $('.modal form').prop('action', '/dashboard/levels');
    $('.modal-footer button[type=submit]').html('Simpan');
    $('#id').val('');
    $('#name').val('');
});

$(document).on('click', '.editLevel', function () {
    const id = $(this).data('id');
    $('input[name=_method]').val('PUT');
    $('#levelModalLabel').html('Perbarui Level');
    $('.modal form').prop('action', '/dashboard/levels/' + id);
    $('.modal-footer button[type=submit]').html('Perbarui');
    $.ajax({
        url: '/dashboard/levels/' + id,
        method: 'get',
        dataType: 'json',
        success: function (response) {
            $('#id').val(response.id);
            $('#name').val(response.name);
        }
    });
});

$('.addCategory').on('click', function () {
    $('#categoryModalLabel').html('Kategori Baru');
    $('input[name=_method]').val('POST');
    $('.modal form').prop('action', '/dashboard/categories');
    $('.modal-footer button[type=submit]').html('Simpan');
    $('#id').val('');
    $('#name').val('');
});

$(document).on('click', '.editCategory', function () {
    const id = $(this).data('id');
    $('input[name=_method]').val('PUT');
    $('#categoryModalLabel').html('Perbarui Kategori');
    $('.modal form').prop('action', '/dashboard/categories/' + id);
    $('.modal-footer button[type=submit]').html('Perbarui');
    $.ajax({
        url: '/dashboard/categories/' + id,
        method: 'get',
        dataType: 'json',
        success: function (response) {
            $('#id').val(response.id);
            $('#name').val(response.name);
        }
    });
});

$('.addTag').on('click', function () {
    $('#tagModalLabel').html('Tag Baru');
    $('input[name=_method]').val('POST');
    $('.modal form').prop('action', '/dashboard/tags');
    $('.modal-footer button[type=submit]').html('Simpan');
    $('#id').val('');
    $('#name').val('');
});

$(document).on('click', '.editTag', function () {
    const id = $(this).data('id');
    $('input[name=_method]').val('PUT');
    $('#tagModalLabel').html('Perbarui Tag');
    $('.modal form').prop('action', '/dashboard/tags/' + id);
    $('.modal-footer button[type=submit]').html('Perbarui');
    $.ajax({
        url: '/dashboard/tags/' + id,
        method: 'get',
        dataType: 'json',
        success: function (response) {
            $('#id').val(response.id);
            $('#name').val(response.name);
        }
    });
});

$('.addMenu').on('click', function () {
    $('#menuModalLabel').html('Menu Baru');
    $('input[name=_method]').val('POST');
    $('.modal form').prop('action', '/dashboard/menus');
    $('.modal-footer button[type=submit]').html('Simpan');
    $('#id').val('');
    $('#name').val('');
    $('#link').val('');
    $('#child option[value=""]').prop('selected', true);
    $('#sort').val('');
});

$(document).on('click', '.editMenu', function () {
    const id = $(this).data('id');
    $('input[name=_method]').val('PUT');
    $('#menuModalLabel').html('Perbarui Menu');
    $('.modal form').prop('action', '/dashboard/menus/' + id);
    $('.modal-footer button[type=submit]').html('Perbarui');
    $.ajax({
        url: '/dashboard/menus/' + id,
        method: 'get',
        dataType: 'json',
        success: function (response) {
            const child = response.child ? response.child : '';
            $('#id').val(response.id);
            $('#name').val(response.name);
            $('#link').val(response.link);
            $('#child option[value="' + child + '"]').prop(
                'selected', true);
            $('#sort').val(response.sort);
        }
    });
});

$(document).on('click', '.editSection', function () {
    const id = $(this).data('id');
    $('input[name=_method]').val('PUT');
    $('#sectionModalLabel').html('Perbarui Section');
    $('.modal form').prop('action', '/dashboard/sections/' + id);
    $('.modal-footer button[type=submit]').html('Perbarui');
    $.ajax({
        url: '/dashboard/sections/' + id,
        method: 'get',
        dataType: 'json',
        success: function (response) {
            const status = response.status ? response.status : '0';
            $('#id').val(response.id);
            $('#name').val(response.name);
            $('#status option[value="' + status + '"]').prop('selected', 'selected');
        }
    });
});

$(document).on('click', '.replyComment', function () {
    const id = $(this).data('id');
    $.ajax({
        url: '/dashboard/comments/' + id,
        method: 'get',
        dataType: 'json',
        success: function (response) {
            $('#reply_id').val(response.comment.id);
            $('#post_id').val(response.comment.post_id);
            $('#name').val(response.comment.name);
            $('#email').val(response.comment.email);
            $('#comment1').val(response.comment.comment);
            $('#comment').val(response.reply ? response.reply.comment : '');
        }
    });
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

$(document).ready(function () {
    $('#customTable').DataTable({
        "lengthChange": false,
        "paging": false,
        "bInfo": false
    });

    $('#tableStandar').DataTable();
});