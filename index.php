<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include("header.php"); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="cover.css">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      #sourrounding_div {
          position: fixed;
          top: 0;
          left: 0;
      }
    </style>
    <title>Visualizador de Lista de Espera Chilena</title>
  </head>
  <body class="text-center">
    <div id="sourrounding_div" style="width:100%;height:100%">

<canvas id="my_canvas" class="my_canvas"></canvas>
</div>
  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
<header class="masthead mb-auto">

</header>

<main role="main" class="inner cover">
  <h1 class="display-4">Visualizador de Lista de Espera Chilena</h1>
  <p class="lead">Navega a través de cada una de las especialidades descubriendo cuáles son las palabras más importantes dentro de cada una.</p>
  <p class="lead">
    <a href="viz.php" class="btn btn-lg btn-primary">Comenzar</a>
  </p>

<br>
</main>

<footer class="mastfoot mt-auto">

</footer>
</div>
<?php include("footer.php") ?>
<script type="text/javascript">
$(document).ready(function() {

  var div = document.getElementById("sourrounding_div");

  var canvas = document.getElementById("my_canvas");

  canvas.height = div.offsetHeight;

  canvas.width  = div.offsetWidth;
  var list = [['talla', 200], ['sindrome', 183], ['baja', 159], ['desarrollo', 124], ['rdsm', 122], ['dismorfico', 115], ['retraso', 107], ['down', 82], ['genopatia', 66], ['dismorfias', 62], ['discapacidad', 62], ['sem', 60], ['global', 60], ['leve', 58], ['intelectual', 58], ['espectro', 52], ['autista', 49], ['congenita', 49], ['control', 47], ['mental', 47], ['lenguaje', 45], ['autismo', 45], ['familiar', 43], ['rnt', 43], ['epilepsia', 41], ['crecimiento', 39], ['genetico', 37], ['rnpt', 35], ['retardo', 35], ['genetica', 33], ['malformacion', 31], ['alta', 31], ['marfan', 31], ['antec', 29], ['peg', 29], ['severo', 27], ['microcefalia', 27], ['oseo', 27], ['hipotonico', 27], ['neurofibromatosis', 25], ['cognitiva', 25], ['hipotonia', 25], ['faciales', 23], ['severa', 23], ['solicita', 23], ['normal', 23], ['distrofia', 23], ['moderado', 23], ['semanas', 21], ['ehlers', 21], ['danlos', 21], ['hiperlaxitud', 21], ['antecedentes', 21], ['deficit', 19], ['predominio', 19], ['menores', 19], ['aeg', 19], ['controles', 19], ['macrocefalia', 17], ['desnutricion', 17], ['cohen', 17], ['psicomotor', 17], ['facial', 17], ['moderada', 17], ['tea', 17], ['madre', 16], ['abuela', 16], ['deficiencia', 16], ['malformaciones', 16], ['congenitas', 16], ['polidactilia', 16], ['microtia', 16], ['fetal', 16], ['fragil', 16], ['hipoacusia', 16], ['turner', 16], ['operada', 16], ['george', 16], ['solicito', 16], ['obesidad', 16], ['geg', 14], ['convulsivo', 14], ['displasia', 14], ['trisomia', 14], ['motor', 14], ['diagnostico', 14], ['deterioro', 14], ['comportamiento', 14], ['fisura', 12], ['congenito', 12], ['conducta', 12], ['dsm', 12], ['neonatal', 12], ['sindromes', 12], ['refractaria', 12], ['anos', 12], ['portador', 12], ['embriopatia', 12], ['drogas', 12], ['moya', 12], ['plastica', 12], ['grado', 12], ['valv', 12], ['prematuro', 10], ['descartar', 10], ['hipotiroidismo', 10], ['renal', 10], ['edad', 10], ['leves', 10], ['febril', 10], ['kabuki', 10], ['rasgos', 10], ['tgd', 10], ['muscular', 10], ['ant', 10], ['cardiopatia', 10], ['familiares', 10], ['tdah', 10], ['completo', 10], ['asimetria', 10], ['articular', 10], ['huesos', 10], ['impresiona', 8], ['cognitivo', 8], ['gastrosquisis', 8], ['hermano', 8], ['parte', 8], ['debido', 8], ['poland', 8], ['falta', 8], ['infertilidad', 8], ['tetralogia', 8], ['fallot', 8], ['maligna', 8], ['padre', 8], ['operado', 8], ['especificados', 8], ['ictiosis', 8], ['confirmar', 8], ['habla', 8], ['apneas', 8], ['sistema', 8], ['nervioso', 8], ['agenesia', 8], ['hipertonico', 8], ['deglucion', 8], ['insuficiencia', 8], ['pie', 8], ['malformativo', 8], ['infantil', 8], ['cariograma', 8], ['apnea', 8], ['perdio', 8], ['estudioobs', 8], ['consejo', 8], ['tipos', 8], ['alto', 8], ['linea', 8], ['ninez', 8], ['recien', 8], ['nacido', 8], ['hiperlaxo', 8], ['craneo', 8], ['cara', 8], ['pediatrica', 8], ['ptosis', 8], ['crisis', 8], ['miotonica', 8], ['antecedente', 8], ['generalizado', 8], ['contexto', 6], ['hijos', 6], ['hiperactividad', 6], ['pendiente', 6], ['esqueletica', 6], ['albinismo', 6], ['elementos', 6], ['carga', 6], ['cromosoma', 6], ['gestacional', 6], ['sobrecrecimiento', 6], ['ndrome', 6], ['fisiologico', 6], ['esperado', 6], ['mala', 6], ['velocidad', 6], ['deficicencia', 6], ['manchas', 6], ['alt', 6], ['colageno', 6], ['molecular', 6], ['neurosensorial', 6], ['actual', 6], ['macrosomia', 6], ['snc', 6], ['cuerpo', 6], ['calloso', 6], ['probable', 6], ['paralisis', 6], ['acondroplasia', 6]]

  WordCloud(document.getElementById('my_canvas'), {
    list: list,
    drawOutOfBound: false,
    // minRotation: 0,
    // maxRotation: 0,
    backgroundColor: '#fff',
    color: function (word, size) {
return (size > 99) ? '#eee' : '#ddd';
},
weightFactor: function (size) {
return Math.log(size) * 20  ;
},
gridSize: 20


  } );

})

</script>
</body>
</html>
