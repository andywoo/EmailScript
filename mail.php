<?php

// Get HTML form input from POST
$name=$_POST['name'];
$email=$_POST['email'];
$website=$_POST['url'];
$message=$_POST['message'];

// Check if email injection attempt was detected
if (IsInjected($email))
{
    // JavaScript messages to alert user
    echo "<script type='text/javascript'>alert('Email injection detected!')</script>";
    echo "<script type='text/javascript'>window.location = 'index.html'</script>";
}

// Validate input, if not already done elsewhere
if(empty($name)||empty($email)||empty($message)) 
{
    // JavaScript messages to alert user
    echo "<script type='text/javascript'>alert('Please fill out the form properly!')</script>";
    echo "<script type='text/javascript'>window.location = 'contact.html'</script>";
}
else if (!empty($name)&&!empty($email)&&!empty($message))
{
    $body .= "Name: " . $name . "\n"; 
    $body .= "Email: " . $email . "\n"; 
    $body .= "Website: " . $website . "\n"; 
    $body .= "Message: " . $message . "\n"; 

    // Put your email here, as well as a subject line you'd recognize
    mail("hello@yourdomain.com","New email",$body); 

    // JavaScript thank-you message
	echo "<script type='text/javascript'>alert('Thanks for your message! I will be in touch.')</script>";
    echo "<script type='text/javascript'>window.location = 'index.html'</script>";
}


// Use a function to check for email injection
function IsInjected ($str)
{
    // Account for common injection techniques
    $injCheck = array('(\n+)', '(\r+)', '(\t+)', '(%0A+)', '(%0D+)', '(%08+)', '(%09+)');
    $inject = join('|', $injCheck);
    $inject = "/$inject/i";

    // Perform comparison
    if (preg_match($inject, $str))
    {
        return true;
    }
    else
    {
        return false;
    }
}

?>
