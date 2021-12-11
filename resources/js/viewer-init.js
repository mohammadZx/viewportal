const WZoom = require('./wheelzoom')

$('.btn-viewer').click(function() {
    $('#vimage').attr('src', $(this).attr('data-src'))
    viewerTools.reset();
    viewerTools.do();
})

viewerTools = {
    filters: {
        invert: 0,
        contrast: 1,
        brightness: 1
    },
    transforms: {
        rotate: 0,
        rotateY: 0,
        rotateX: 0,
        scale: 1
    },
    zoomDef: function() {
        this.transforms.scale = 1
    },
    zoomIn: function() {
        this.transforms.scale += .2
    },
    zoomOut: function() {
        this.transforms.scale -= .2
    },
    rotateRight: function() {
        this.transforms.rotate += 90
    },
    rotateleft: function() {
        this.transforms.rotate -= 90
    },
    flipH: function() {
        this.transforms.rotateY += 180
    },
    flipV: function() {
        this.transforms.rotateX += 180
    },
    invert: function() {
        this.filters.invert = this.filters.invert == 1 ? 0 : 1
    },
    reset: function() {
        this.filters.invert = 0
        this.filters.contrast = 1
        this.filters.brightness = 1
        this.transforms.rotateX = 0
        this.transforms.rotateY = 0
        this.transforms.rotate = 0
        this.transforms.scale = 1
        $('#vimage').css('top', 0)
        $('#vimage').css('left', 0)

    },
    print: function() {
        $('#viewer .v-image').css('position', 'fixed')
        $('#viewer .v-image').css('top', '0')
        $('#viewer .v-image').css('left', '0')
        $('#viewer .v-image').css('width', '100%')
        $('#viewer .v-image').css('height', '100%')
        $('#viewer .v-image').css('background', '#fff')
        window.print()
        $('#viewer .v-image').css('position', 'unset')
        $('#viewer .v-image').css('top', '0')
        $('#viewer .v-image').css('left', '0')
        $('#viewer .v-image').css('width', 'unset')
        $('#viewer .v-image').css('height', 'unset')
        $('#viewer .v-image').css('background', 'none')

    },
    contrast: function(el) {
        this.filters.contrast = el.val() / 100
    },
    brightness: function(el) {
        this.filters.brightness = el.val() / 100
    },
    do: function() {
        var filters = ""
        var transforms = ""
        Object.entries(viewerTools.filters).forEach(([key, val]) => {
            filters += ` ${key}(${val})`
        });
        $('#vimage').css('filter', filters)

        Object.entries(viewerTools.transforms).forEach(([key, val]) => {
            transforms += ` ${key}(${val}${key != 'scale' ? 'deg' : ''})`
        });
        $('#vimage').css('transform', transforms)
    }
}

$('.v-tools .tool:not(input)').click(function() {
    viewerTools[$(this).attr('data-function')]()
    viewerTools.do()
});

$('.v-tools input.tool').on('change', function() {
    viewerTools[$(this).attr('data-function')]($(this))
    viewerTools.do()
});


$(function() {
    $('#vimage').dragZoom({
        scope: $("body"),
        zoom: 1,
        onWheelStart: function() {

        }
    }, function() {});
});