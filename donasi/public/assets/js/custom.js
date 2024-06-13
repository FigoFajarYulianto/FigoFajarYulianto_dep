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
