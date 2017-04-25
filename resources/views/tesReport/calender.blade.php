<html>

   <head>
      <title>The jQuery Example</title>
      <script type = "text/javascript"
         src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		  {!! Charts::assets() !!}
      <script type = "text/javascript" language = "javascript">

      </script>
   </head>



    </head>
    <body>
        <center>


        </center>



      <script>
      $(document).ready(function() {


    $.getJSON('http://localhost:8000/caseliststatus', function (dataTableJson) {
    lava.loadData('Chart1', dataTableJson, function (chart) {
        
    });
    });

      });


      </script>
    </body>
</html>
