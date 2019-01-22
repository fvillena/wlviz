<?php

$list = file_get_contents("corpus/".urldecode($_GET["specialty"]).".txt");
$path    = 'corpus';
$files = array_diff(scandir($path), array('.', '..'));
if (!isset($_GET["specialty"])) {
  header('Location: index.php?specialty=BRONCOPULMONAR');
}

 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <style>
    canvas {
        padding-left: 0;
        padding-right: 0;
        margin-left: auto;
        margin-right: auto;
        display: block;
    }
    h1 {
      text-align: center;
    }
    form {
      text-align: center;
    }
    </style>
    <title></title>
  </head>
  <body>
    <h1><?php echo urldecode($_GET["specialty"]); ?></h1>
    <div id="sourrounding_div" style="width:100%;height:500px">
    <canvas id="my_canvas" class="my_canvas" width=1000 height=500></canvas>
    </div><br>
    <form class="" action="index.php" method="get">
      <select class="" name="specialty">
        <?php
        foreach($files as $item) {
            $item = strtolower($item);
            $item = pathinfo($item, PATHINFO_FILENAME);
            if ($_GET["specialty"] == strtoupper($item) ){
              $selected = "selected";
            }
            else {
              $selected = "";
            }
            echo "<option ".$selected." value=".rawurlencode(strtoupper($item)).">".$item."</option>";
        }
         ?>
      </select>
      <input type="submit" name="" value="ir">
    </form>

  </body>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="wordcloud2.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {

      var div = document.getElementById("sourrounding_div");

var canvas = document.getElementById("my_canvas");

canvas.height = div.offsetHeight;

canvas.width  = div.offsetWidth;
      var list = <?php echo $list; ?>

      WordCloud(document.getElementById('my_canvas'), {
        list: list,
        drawOutOfBound: true,
        minRotation: 0,
        maxRotation: 0


      } );

    })
  </script>
</html>
