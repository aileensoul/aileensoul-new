<html>
    <head>
        <style>
            div {
    height: 100px;
    background: aqua;
    overflow: auto;
}
        </style>
    </head>
    
    <body>
        <div id="chatting">
            <ul>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    <li>alskdjg;j ;jhe ;he fkh</li>
    
            </ul>
</div>
    </body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script>
    var height = 0;
$('#chatting ul').each(function(i, value){
    height += parseInt($(this).height());
});

height += '';

$('div').animate({scrollTop: height});
    </script>
</html>