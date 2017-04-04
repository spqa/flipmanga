(function($, fabric) {

    var fabric = fabric || window.fabric;
    var canvas = new fabric.Canvas('editor');
    canvas.setDimensions({
        width : 300,
        height : 400
    });

    $('.btn-preview').click(function() {
        var imgSrc = $('#image').val();
        $('.btn-add-text').removeClass('hide');
        if (!imgSrc) {
            imgSrc = 'http://i.memeful.com/template/521ee7a0bf0fb/LR8ZQwv.jpg';
        }
        fabric.Image.fromURL(imgSrc, function(img) {

            canvas.setDimensions({
                width : img.width,
                height : img.height
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
            fontFamily: 'Impact',
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

        var img = canvas.toDataURL("image/jpg");
        $('#preview').attr("src", img);

        // window.open(img);
    });

})(jQuery, fabric);