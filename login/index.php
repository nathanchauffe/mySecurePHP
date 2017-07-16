<?php

// Inialize session
 session_start();

// Check, if user is already login, then jump to secured page
if (isset($_SESSION['username'])) {
header('Location: /login/user/index.php');
}

//Get the header.
require('sys/header.html');
?>
  <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h2>Secure PHP & MySQL</h2>
        <p>MySecurePHP is a is lightweight and secure user management application designed to easily integrate into most web applications. Download it on GitHub today or register as a new user on our live demo!</p>
        <p><a class="btn btn-primary btn-lg" href="/login/new/index.html" role="button">Register New User</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Popular Frameworks</h2>
          <p>MySecurePHP is built on the latest version of the bootstrap.js framework. Standard installation also includes jQuery, Font Awesome 4.7, Datatables  and Metis Menu. </p>
          
        </div>
        <div class="col-md-4">
          <h2>Security Features</h2>
          <p>The latest standards are used for password hashing and user authentication. MySecurePHP can detect mailicious activity and will automatically block the appropriate username and/or IP address. There is also documentation provided on how to customize and scale its many features. </p>
       
       </div>
        <div class="col-md-4">
          <h2>Dashboard</h2>
          <p>MySecurePHP utilizes SB Admin v.2 as from startbootstrap.com a dashboard controller. 
          Administraitors can view trends on Google charts, Morris.js, or directly on Datatables. 
          The dashboard is designed to handle all necessary functions without an admin having to directly access MySQL. </p>
        
        </div>
      </div>
</div>
<?php
//Get the footer.
require('sys/footer.html');
?>

