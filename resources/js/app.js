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
$('#typeuserselect option[value=' + ($('#typeuserselect').attr('value') || 'customer') + ']').attr('selected', true);
if ($('#typeuserselect').val().substring(0, 6) == 'expert') {
    $('#expert').css('display', 'block');
    $('#expert:not(.edit) input').attr('required', 'true')
}
$('#typeuserselect').on('change', function() {
    if ($(this).val().substring(0, 6) == 'expert') {
        $('#expert').css('display', 'block');
        $('#expert:not(.edit) input').attr('required', 'true')
        return;
    }
    $('#expert').css('display', 'none');
    $('#expert input').removeAttr('required')

});

//* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}

$('form.confirm').on('submit', getConfirm)
$('confirm:not(form)').on('click', getConfirm)

function getConfirm() {
    if (confirm('آیا از حذف این کاربر اطمینان دارید؟')) {
        return true;
    }
    window.event.preventDefault();
}
$('.toggleclass').click(function() {
    $($(this).attr('data-class')).toggleClass('active');
})