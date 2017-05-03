<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title></title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    
    <script src='https://unpkg.com/mapillary-js@2.5.0/dist/mapillary.min.js'></script>
    <link href='https://unpkg.com/mapillary-js@2.5.0/dist/mapillary.min.css' rel='stylesheet' />
  
    <style>
        html, body { margin: 0; padding: 0; height: 100%; }
        #mly { height: 100%; }
    </style>
</head>

<body>
    <div id='mly'></div>

    <script>
        var mly = new Mapillary.Viewer(
            'mly',
            'LXJVNHlDOGdMSVgxZG5mVzlHQ3ZqQTo0NjE5OWRiN2EzNTFkNDg4',
            <?php echo $_GET['photoid'] ?>,
            {
                component: {
                    cover: false,
                },
            });
        
        // Viewer size is dynamic so resize should be called every time the window size changes
        window.addEventListener("resize", function() { mly.resize(); });
    </script>
</body>
</html>