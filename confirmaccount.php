<?php
session_start();
if(!isset($_POST['txtName']))
{
	$textName="Not data supplied";
}
else
{
	$textName=$_POST['txtName'];
}
if(!isset($_POST['txtUsername']))
{
	$textUsername="Not data supplied";
}
else
{
	$textUsername=$_POST['txtUsername'];
}

if(!isset($_POST['txtPass1']))
{
	$textPassword="Not data supplied";
}
else
{
	$textPassword=$_POST['txtPass1'];
}
if(!isset($_POST['txtEmail']))
{
	$textEmail="Not data supplied";
}
else
{
	$textEmail=$_POST['txtEmail'];
}
if(!isset($_POST['addr1']))
{
	$addr1="Not data supplied";
}
else
{
	$addr1=$_POST['addr1'];
}
if(!isset($_POST['addr2']))
{
	$addr2="Not data supplied";
}
else
{
	$addr2=$_POST['addr2'];
}
if(!isset($_POST['postcode']))
{
	$postcode="Not data supplied";
}
else
{
	$postcode=$_POST['postcode'];
}
if(!isset($_POST['phone']))
{
	$phone="Not data supplied";
}
else
{
	$phone=$_POST['phone'];
}

/* if btnSubmit is clicked first thing we do is we check if password fields match with each other 
if they match then next thing that we do is that we check if the username provided already exist in 
database or not, if it does we get back to user  and say sorry this username has already beeen taken 
please enter another one. if it doesn't we generate a 16- characters random string and store that 
value to $verifyString. Then we add user to database but with active field equals to zero meaning 
that his account is not active yet. An email is then sent to user with the link from where user 
can activate the account. To send an email we configured SMTP to our server. 
mail() method accepts three arguments: recepient's email, subject and body.
*/
if(isset($_POST['btnSubmit']))
{
    require 'config.php';
    if($_POST['txtPass1']==$_POST['txtPass2']){
    $stmt=$pdo ->prepare('SELECT * FROM login WHERE username=?');
    $stmt ->execute([$textUsername]);
    $num_rows = $stmt->rowCount();
    if($num_rows==1)
    {
    header("Location:register.php?error=take");
    }
    else
        {
          $randomstring='';
         for($i=0;$i<16;$i++)
            {
             $randomstring.=chr(mt_rand(32,126));
            }
             $verifyurl="http://localhost/carhunters.co.uk/verify.php";
             $verifystring=urlencode($randomstring);
             $verifyemail=$_POST['txtEmail'];
             $validusername=urlencode($_POST['txtUsername']);
             $sql = "INSERT INTO login (name,username, pwd,email_id,verifystring,active,address1,address2,postcode,phone) VALUES (?,?,?,?,?,?,?,?,?,?)";
             $stmt=$pdo ->prepare($sql);
             $stmt->execute([$textName, $textUsername, $textPassword,$textEmail,addslashes($randomstring),0,$addr1,$addr2,$postcode,$phone]);
             $mail_body=<<<_MAIL_
              Hi $validusername,
              Please click on the following link to verify your new account:
              $verifyurl?usr=$validusername&ver=$verifystring    
              _MAIL_;
             mail($_POST['txtEmail'],"User Verification",$mail_body);
        }
    }
    else
    {
        header("Location:register.php?error=pass");
    }


 } 
else
{
    switch($_GET['error'])
    {
        case "pass":
        echo 'Password do not match';
        break;
        case "taken":
        echo 'Username taken, please use another ';
        break;
        case "no":
        echo 'Incorrect login details';
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Confirm Account</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="./css/account.css">
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#313c53" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#313c53" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Check your inbox. Click the link we've sent you to verify your account.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="border-radius: 3px;" bgcolor="#313c53"><a href="index.php" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;">OK</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                    
                    
                        
                </table>
            </td>
        </tr>
    </table>
</body>

</html>