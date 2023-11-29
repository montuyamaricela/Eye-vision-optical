<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    function startDrag(e) {
        // determine event object
        if (!e) {
            var e = window.event;
        }

        // IE uses srcElement, others use target
        var targ = e.target ? e.target : e.srcElement;

        if (targ.className != 'dragme') {
            return
        };
        // calculate event X, Y coordinates
        offsetX = e.clientX;
        offsetY = e.clientY;

        // assign default values for top and left properties
        if (!targ.style.left) {
            targ.style.left = '0px'
        };
        if (!targ.style.top) {
            targ.style.top = '0px'
        };

        // calculate integer values for top and left 
        // properties
        coordX = parseInt(targ.style.left);
        coordY = parseInt(targ.style.top);
        drag = true;

        // move div element
        document.onmousemove = dragDiv;

    }

    function dragDiv(e) {
        if (!drag) {
            return
        };
        if (!e) {
            var e = window.event
        };
        var targ = e.target ? e.target : e.srcElement;
        // move div element
        targ.style.left = coordX + e.clientX - offsetX + 'px';
        targ.style.top = coordY + e.clientY - offsetY + 'px';
        return false;
    }

    function stopDrag() {
        drag = false;
    }
    window.onload = function() {
        document.onmousedown = startDrag;
        document.onmouseup = stopDrag;
    }
    </script>
    <style lang="">
    .dragme {
        position: relative;
        width: 270px;
        height: 203px;
        cursor: move;
    }

    #draggable {
        position: relative;
        background-color: #ccc;
        border: 1px solid #000;
    }
    </style>
</head>

<body>
    <div id="draggable" class="dragme">"Hello World!"</div>
    <div>
        <img src="https://lh4.googleusercontent.com/-8tqTFxi2ebU/Ufo4j_thf7I/AAAAAAAADFM/_ZBQctm9e8E/w270-h203-no/flower.jpg"
            alt="drag-and-drop image script" title="drag-and-drop image script" class="dragme">
    </div>

</body>

</html>