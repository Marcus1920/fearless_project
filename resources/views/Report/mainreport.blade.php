<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap-grid.min.css">

<style media="screen">
body{

  background: rgba(255,255,255,1);
  background: -moz-linear-gradient(-45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,1) 47%, rgba(246,246,246,1) 51%, rgba(237,237,237,1) 88%, rgba(237,237,237,1) 100%);
  background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(255,255,255,1)), color-stop(47%, rgba(237,237,237,1)), color-stop(51%, rgba(246,246,246,1)), color-stop(88%, rgba(237,237,237,1)), color-stop(100%, rgba(237,237,237,1)));
  background: -webkit-linear-gradient(-45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,1) 47%, rgba(246,246,246,1) 51%, rgba(237,237,237,1) 88%, rgba(237,237,237,1) 100%);
  background: -o-linear-gradient(-45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,1) 47%, rgba(246,246,246,1) 51%, rgba(237,237,237,1) 88%, rgba(237,237,237,1) 100%);
  background: -ms-linear-gradient(-45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,1) 47%, rgba(246,246,246,1) 51%, rgba(237,237,237,1) 88%, rgba(237,237,237,1) 100%);
  background: linear-gradient(135deg, rgba(255,255,255,1) 0%, rgba(237,237,237,1) 47%, rgba(246,246,246,1) 51%, rgba(237,237,237,1) 88%, rgba(237,237,237,1) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=1 );

}


</style>

        <title>My Charts</title>

        {!! Charts::assets() !!}

    </head>
    <body>

    <div class="row" style="background:transparent">

      <div class="col-md-6"  style="background:transparent">
            {!! $chart->render() !!}
      </div>

      <div class="col-md-6">
          {!! $charts->render() !!}
      </div>

    </div>
    <div class="row" style="background:transparent">

      <div class="col-md-6"  style="background:transparent">
                {!! $chartss->render() !!}
      </div>

      <div class="col-md-6">
          {!! $chartssz->render() !!}
      </div>

    </div>


        <center>

        </center>

        <center>

        </center>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js" charset="utf-8"></script>

    </body>
