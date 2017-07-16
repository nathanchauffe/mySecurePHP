<?php

// Inialize session
 session_start();
//Get the header
require('sys/bl_head.html');

// Load secure common files
require($_SERVER['DOCUMENT_ROOT'] . '/frame/coms.php');

// If there is any value in the random hash...
if($_GET['id']){
$id = $_GET['id'];		 
echo "
<script src='/frame/include/script.js'></script>
<title>Reset Password</title></head>
<body>
<div align='center'>

<div class='container' style='padding-top:30px;'>
        <div class='row'>
            <div class='col-md-4 col-md-offset-4'>
                <div class='login-panel panel panel-default'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Verify Email</h3>
                    </div>
                    <div class='panel-body'><form method='POST' action='sys/veri_em.php'>
                          <input type='hidden' name='id' value='$id'/>
                    <div style='padding-bottom:20px'>For security, please enter the email address a associated with your account.</div>
                        <form role='form' method='POST' action='sys/forgot.php'>
                    		<input type='hidden' name='reset' value='reset'/>
                            <fieldset>
                                <div class='form-group'> 
								<input class='form-control' placeholder='E-mail' name='username' type='email' autofocus >
                                </div><div class='checkbox'></div>
                                <!-- Change this to a button or input when using this as a form -->
                               <input type='submit' class='btn btn-lg btn-success btn-block' />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



";

//Get the footer.
require(footer.html);

} else {
header('Location: /404.html');

}


?>


