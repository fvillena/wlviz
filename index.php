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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
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
    <title><?php echo urldecode($_GET["specialty"]); ?></title>
  </head>
  <body class="container">
    <h1 class="display-1"><?php echo urldecode($_GET["specialty"]); ?></h1>
    <div class="jumbotron">

    <div id="sourrounding_div" style="width:100%;height:400px">
    <canvas id="my_canvas" class="my_canvas"></canvas>
    </div><br>


  </div>
  <form class="form-inline justify-content-center" action="index.php" method="get">
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
  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
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
