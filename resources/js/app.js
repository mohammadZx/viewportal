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
if ($('#typeuserselect').val() && $('#typeuserselect').val().substring(0, 6) == 'expert') {
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



// uploader


var requestCounter = 0;
var imageCounter = $('.image-count-box').attr('data-count');

function requestFileUploader() {
    $(".reqfile").on("change", function(e) {
        f = this.files[0]
        if (!imageCounter) return;
        if (istype(f, 'image')) {
            insertStatus = imageHandler(this, f)
        }
        if (istype(f, 'audio')) {
            insertStatus = audioHandler(this, f)
        }

        if (insertStatus) {
            requestCounter++;
            $(`<div class=""> <input accept="image/*,audio/*" class="d-none reqfile" type="file" id="files${requestCounter}" name="files[]" /> </div>`).insertAfter($(this).parent());
            $('.labelfor').attr('for', 'files' + requestCounter);
            imageCounter--;
            $('.image-count-box .count-image').text(imageCounter);
        }


        $(".remove").click(function() {
            $(this).parent().parent().remove()
            if (imageCounter != $('.image-count-box').attr('data-count')) {
                imageCounter++
            }
            $('.image-count-box .count-image').text(imageCounter);
        })
        requestFileUploader()
    });
}
requestFileUploader()

function imageHandler(object, f) {
    if (f.size >= 300000) {
        alert('حجم تصویر باید زیر 300 کیلوبایت باشد')
        return false;
    }
    var obj = URL.createObjectURL(f);
    $(object).parent().addClass('col-md-3');
    $(object).parent().append(`<div class='imgreq'><img class='imageThumb' src='${obj}'> <span class='remove'><i class='fa fa-window-close'></i></span></div>`);
    return true;
}

function audioHandler(object, f) {
    if (f.size >= 10000000) {
        alert('حجم صوت باید زیر 10 مگابایت باشد')
        return false;
    }
    var obj = URL.createObjectURL(f);
    $(object).parent().addClass('col-md-3');
    $(object).parent().append(`<div class='imgreq'><audio src="${obj}" controls width="100%" style="max-width: 100%;" ></audio> <span class='remove'><i class='fa fa-window-close'></i></span></div>`);
    return true;
}

function istype(file, type) {    
    return file && file['type'].split('/')[0] === type;
}