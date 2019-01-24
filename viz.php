<?php

$list = file_get_contents("corpus/".urldecode($_GET["specialty"]).".txt");
$path    = 'corpus';
$files = array_diff(scandir($path), array('.', '..'));
if (!isset($_GET["specialty"])) {
  header('Location: ?specialty=BRONCOPULMONAR');
}

 ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include("header.php"); ?>
    <title><?php echo urldecode($_GET["specialty"]); ?></title>
  </head>
  <body class="container">
    <h1 class="display-1"><?php echo urldecode($_GET["specialty"]); ?></h1>
    <div class="jumbotron">

    <div id="sourrounding_div" style="width:100%;height:400px">
    <canvas id="my_canvas" class="my_canvas"></canvas>
    </div><br>


  </div>
  <form class="form-inline justify-content-center" action="" method="get">
    <select class="form-control form-control-lg" name="specialty" onchange='this.form.submit();'>
      <?php
      foreach($files as $item) {
          $item = strtolower($item);
          $item = pathinfo($item, PATHINFO_FILENAME);
          if (urldecode($_GET["specialty"]) == strtoupper($item) ){
            $selected = "selected";
          }
          else {
            $selected = "";
          }
          echo "<option ".$selected." value=".rawurlencode(strtoupper($item)).">".$item."</option>";
      }
       ?>
    </select>

  </form><br>
  <?php include("footer.php") ?>
  </body>

  <script type="text/javascript">
    $(document).ready(function() {

      var div = document.getElementById("sourrounding_div");

var canvas = document.getElementById("my_canvas");

canvas.height = div.offsetHeight;

canvas.width  = div.offsetWidth;
      var list = <?php echo $list; ?>

      WordCloud(document.getElementById('my_canvas'), {
        list: list,
        drawOutOfBound: false,
        // minRotation: 0,
        // maxRotation: 0,
        backgroundColor: '#e9ecef',
        color: function (word, size) {
    return (size > 99) ? '#007bff' : '#6c757d';
  },
  weightFactor: function (size) {
    return Math.log(size) * 20  ;
  },
  gridSize: 20


      } );

    })
  </script>
</html>
