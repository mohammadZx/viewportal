init();

function init() {
    //generate image
    var img = document.createElement("img");
    var url = new URL(window.location.href);
    var imageUrl = 'https://avatars.githubusercontent.com/u/39435053?v=4';

    img.src = imageUrl;
    img.style.display = "none";
    document.getElementById("imgli").appendChild(img);

    //set width and height
    var width = getWidth();
    var heights = getHeight() - 63;
    var heightsvie = getHeight() - 66;
    document.getElementById("imageview").style.height = heights + "px";
    document.getElementById("docs-pictures").style.height = heightsvie + "px";
}

function fliph() {
    setTimeout(function() {
        var flip = $("#fliph").attr("data-arguments");
        if (flip == "[1]") {
            $("#fliph").attr("data-arguments", "[-1]");
        } else {
            $("#fliph").attr("data-arguments", "[1]");
        }
    }, 10);
}

function flipv() {
    setTimeout(function() {
        var flip = $("#flipv").attr("data-arguments");
        if (flip == "[1]") {
            $("#flipv").attr("data-arguments", "[-1]");
        } else {
            $("#flipv").attr("data-arguments", "[1]");
        }
    }, 10);
}

function getWidth() {
    return Math.max(
        document.body.scrollWidth,
        document.documentElement.scrollWidth,
        document.body.offsetWidth,
        document.documentElement.offsetWidth,
        document.documentElement.clientWidth
    );
}

function getHeight() {
    return Math.max(
        document.body.scrollHeight,
        document.documentElement.scrollHeight,
        document.body.offsetHeight,
        document.documentElement.offsetHeight,
        document.documentElement.clientHeight
    );
}
$('.printv').click(function() {
    printElement($('#viewer-container'))
})

function printElement(e) {
    var ifr = document.createElement('iframe');
    ifr.style = 'height: 0px; width: 0px; position: absolute'
    document.body.appendChild(ifr);

    $(e).clone().appendTo(ifr.contentDocument.body);
    ifr.contentWindow.print();

    ifr.parentElement.removeChild(ifr);
}
$('.closev').click(function() {
    $('.viewer-container-l').toggleClass('active')
})