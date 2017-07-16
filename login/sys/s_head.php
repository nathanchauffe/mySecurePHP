<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <!-- Custom Fonts -->
    <link href="/frame/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->
    <link href="http://www.nathanchauffe.com/frame/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/frame/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/frame/dist/css/jumbotron.css" rel="stylesheet">



   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/login/index.php">mySecurePHP v1.0</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <div align="right" style="color:#ccc;">
          <div><a style="color:#ccc;" href='/login/user/index.php'><i style="color:#ccc;" class="fa fa-user" aria-hidden="true"></i>
<b> <?php echo "$user_current"; ?></b></a></div>
             
           <div>   <a href="/login/user/profile.php">Profile</a> |
         <a href="/login/sys/logout.php">Logout</a>
            </div>
        
    
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
