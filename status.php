<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maindiv">
      <div class="insidediv3">&nbsp;</div>
      <div class="insidediv1"><b>Your Complaint Status</b></div>
      <hr class="custhr">
      <div class="insidediv2">
        <table class="table table-bordered table-responsive" id="tablestatus">
        </table>
      </div>
      <hr class="custhr">
      <div class="insidediv3">&nbsp;</div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        var tickets = getcookie();
        $.get("status2.php", {tickets: tickets}, function(data){
          var d = JSON.parse(data);
          var s = "<tr><th>#</th><th>Complaint ID</th><th>Status</th></tr>";
          for(var i=0;i<d.data.length;i++){
            s = s + "<tr>";
            s = s + "<td>"+ (i+1) +"</td>";
            s = s + "<td>"+ d.data[i].complaint_id +"</td>";
            s = s + "<td>"+ d.data[i].progress +"</td>";
            s = s + "</tr>";
            //console.log(d.data[i].complaint_id);
          }
          $('#tablestatus').html(s);
          //console.log(data);
        });
      });

      function getcookie(){
        var cname = 'ticket';
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        var n=0;
        var ticket = "";
        for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
      }
    </script>
  </body>

</html>