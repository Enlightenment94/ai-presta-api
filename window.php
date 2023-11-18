<script src='js/strOp.js'></script>
<script src='js/ajax.js'></script>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<div id='left-menu'>
    <div id='menu-result'></div>
</div>

<div id='content'>
    <div id='menu-horizontal'>
        <button onclick="ajaxC('c')">category</button>
        <button onclick="ajaxP('p')">products</button>
        <button onclick="ajaxM('m')">manufacturerr</button>
    </div>
    <div id='content-result'></div>
</div>