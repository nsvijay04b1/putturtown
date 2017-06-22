<?php
//include the main validation script
require_once "formvalidator.php";

$show_form=true;

if(isset($_POST['Submit']))
{// The form is submitted

    //Setup Validations
    $validator = new FormValidator();
    $validator->addValidation("name","req","Please fill in Name");
    $validator->addValidation("phone","req","Please fill in Phone number");
	//Now, validate the form
    if($validator->ValidateForm())
    {
        //Validation success. 
        //Here we can proceed with processing the form 
        //(like sending email, saving to Database etc)
        // In this example, we just display a message
        echo "<h2>Thanks for contacting us!</h2>";
		echo "<BR>";
        echo "<a href='index.html'>one more comment? </a>";
        $show_form=false;
    }
    else
    {
        echo "<B>Validation Errors:</B>";

        $error_hash = $validator->GetErrors();
        foreach($error_hash as $inpname => $inp_err)
        {
            echo "<p>$inpname: <BR> $inp_err</p>\n";
        }  
		
		//echo "Please try again";
       // echo "<BR>";
       // echo "<a href='viewguestbook.html'>View guestbook for example ?</a>";
        echo "<BR>";
        echo "<a href='index.html'>Click to try again</a>";

    }//else
}//if(isset($_POST['Submit']))

if(false == $show_form)
{

$host="208.91.198.197"; // Host name 
$username="add_client"; // Mysql username 
$password="add_client"; // Mysql password 
$db_name="db_admin"; // Database name 
$tbl_name="advertise"; // Table name 

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect server "); 
mysql_select_db("$db_name")or die("cannot select DB");


$name="$_POST[name]";
$email="$_POST[email]";
$phone="$_POST[phone]";
$address="$_POST[address]";


$to = "admin@putturtown.com";
$subject = "Hello! I would like to post my add in your website";
$message =  "Name". $name .  "Phone". $phone .  "Address" .$address;
$from = $email;
$headers = "From:" . $from;
//mail($to,$subject,$message,$headers);

if(!mail($to,$subject,$message,$headers))
    {
        echo ' !! sending mail failed !! ';
    }


//$sql="INSERT INTO `$tbl_name`(`name`, `address`,`phone`,`email`)VALUES('$_POST['name']', '$_POST['address']', '$_POST['phone']','$_POST['email']')";
$sql="INSERT INTO `$tbl_name`(`name`, `address`,`phone`,`email`)VALUES('$name', '$address', '$phone', '$email')";
//$sql="INSERT INTO `$tbl_name`(`name`, `email`, `comment`, `datetime`)VALUES('vijay', 'test@gmail.com', 'testing', '$datetime')";
$result=mysql_query($sql);

//check if query successful 
if($result){
echo "<BR>";
echo "we got your details .. will get back to you shortly! ";
echo "<BR>";

// link to view guestbook page
//<h2>echo "<a href='viewguestbook.html'>View guestbook</a>"</h2>;
//echo "<BR>";
//echo "To see all comments";
//echo "<a href='index.html'>back 2 PutturTown</a>";
}

else {
echo "ERROR";
}
mysql_close();
}
?>