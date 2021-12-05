require('./bootstrap');
jalaliDatepicker.startWatch({ separatorChar: "-" });
$(document).ready(function() {
    $('.select2').select2();
});

$('.file').on('change', function() {
    const [file] = this.files
    if (file) {
        $(this).parent().children('img').attr('src', URL.createObjectURL(file))
    }
})

if ($('#typeuserselect').val() == 'expert') {
    $('#expert').css('display', 'block');
    $('#expert input').attr('required', 'true')
}
$('#typeuserselect').on('change', function() {
    if ($(this).val() == 'expert') {
        $('#expert').css('display', 'block');
        $('#expert input').attr('required', 'true')
        return;
    }
    $('#expert').css('display', 'none');
    $('#expert input').removeAttr('required')

});