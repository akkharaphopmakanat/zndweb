<html>
<head>
<title>Signal Box Mittraphap</title>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script>
    $(document).ready(function(){
         $("#div_refresh").load("panel.php");
 
        setInterval(function() {
            $("#div_refresh").load("panel.php");
        }, 2000);
    });
</script>
</head>
<body>
    <div id="div_refresh"></div>
</body>
</html>