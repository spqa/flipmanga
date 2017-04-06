(function($, fabric) {

    var fabric = fabric || window.fabric;
    var canvas = new fabric.Canvas('editor');
    // canvas.setDimensions({
    //     width : 300,
    //     height : 400
    // });

    $('.btn-preview').click(function(e) {
        var imgSrc = $('#image').val();
        $('.editor-control').removeClass('hide');
        if (!imgSrc) {
            imgSrc = 'http://i.memeful.com/template/521ee7a0bf0fb/LR8ZQwv.jpg';
        }
        var img = document.getElementById('preview-image');
//or however you get a handle to the IMG
        var width = img.clientWidth;
        var height = img.clientHeight;
        fabric.Image.fromURL('/api/proxy/image?url='+imgSrc, function(img) {
            img.scaleToWidth(width);
            canvas.setDimensions({
                width : width,
                height : height
            });
            canvas.add(img);
        });
    });

    $('.btn-add-text').click(function() {

        var text = $('#upper-text').val();
        if (!text) {
            text = 'Hello World!';
        }

        var iText = new fabric.IText(text, {
            left: 50,
            top: 50,
            scaleX : 1,
            scaleY : 1,
            padding: 7,
            fontSize: 60,
            textAlign: 'left',
            fontFamily: 'meme',
            caching: false,
            fill: 'white',
            stroke: 'black',
            strokeWidth: 1,
            borderDashArray: [5, 5],
            originX: 'left',
            originY: 'center',
            styles: {},
        });

        canvas.add(iText).setActiveObject(iText);
        canvas.renderAll();

    });

    $('.btn-generate').click(function() {
        canvas.deactivateAll();

        var img1 = canvas.toDataURL();
        $('#encode-image').val(img1);
        $('#preview-image').attr("src", img1);

        // window.open(img);
    });

})(jQuery, fabric);