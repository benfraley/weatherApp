<html>
    <head>
        <title>Benjamin Fraley's Weather App</title>
        <meta charset="UTF-8">
        
        <script type="text/javascript" src="js/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/weatherApp.js"></script>
        
        <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="css/weatherApp.css">
    </head>
    <body>
        <div class="mainForm">
            Start typing and select your location below<br/>
            <input type="text" id="location" name="location" /> <span class="clear" id="clear">X</span>
            <div id="forecast">
                <span class="forecast" id="forecast0"></span>
                <span class="forecast" id="forecast1"></span>
                <span class="forecast"id="forecast2"></span>
            </div>
            <div class="loading" id="loading" style="display:none">
                Loading...
            </div>
        </div>
    </body>
</html>