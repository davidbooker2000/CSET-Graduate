<link href="print.css" rel="stylesheet" type="text/css">
<?php 

/*PHPrint - This file is phprint.php
Make any Page Printer Friendly!
Copyright by MikeNew.Net, Notice must stay intact
************
Legal: MikeNew.Net is not responsible for any damages caused
by use of this script. (Not likely that it will. Hasn't yet.)
This script will make your pages printer friendly. 
Optionally, it will strip images as well. (Instructions for that below)

// After installation, you can remove text from here down to the next: 8< ---->
// Back up/copy this file first.

1. Save this script in the root of the site for simplicity.
2. Place <!-- startprint --> somewhere in your HTML page where you consider 
it to be the start of printer friendly content, and <!-- stopprint --> goes at the end
of that same content.
3. You place a link to phprint.php anywhere on the HTML page (preferably outside the printed content,
like this: <a href="/phprint.php">Print this page</a>
- or however you like, just as long as you link to this script. */

// If you've already tested, you can remove the text from here up to the other: 8< ---->

//Do you want to strip images from the printable output?
// If no, change to "no". Otherwise, images are stripped by default.
$stripImages = "no";

//what's the base domain name of your site, without trailing slash? 
// Just the domain itself, so we can fix any relative image and link problems.
$baseURL="http://www.nsu.edu/cmr/"; 

// That's it! No need to go below here. Upload it and test by going to yoursite.com/page.php
// (The page containing a the two tags and a link to this script)
// -----------------------------------------------------


$refpage = (phpversion() > "4.1.0") ? $_SERVER['HTTP_REFERER'] : $HTTP_SERVER_VARS['HTTP_REFERER'];
// $refpage = (phpversion() > "4.1.0") ? $_SERVER[HTTP_REFERER] : $HTTP_SERVER_VARS[HTTP_REFERER];


$startingpoint = "<!-- startprint -->";
$endingpoint = "<!-- stopprint -->";


// let's turn off any ugly errors for a sec-
error_reporting(0);
// $read = fopen($refpage, "rb") ... may work better if you're using NT and images
$read = fopen($refpage, "r") or die ("<br />Sorry! There is no access to this file directly. You must follow a link. <br /><br />Please click your browser's back button. <br><a href=\"http://miracle2.net/\"><img src=\"http://miracle2.net/i.gif\" alt=\"miracle 2\" border=\"0\"></a>");
// let's turn errors back on so we can debug if necessary
error_reporting(1);

$value = "";
while(!feof($read)){
$value .= fread($read, 16000); // reduce number to save server load
}
fclose($read);
$start= strpos($value, "$startingpoint"); 
$finish= strpos($value, "$endingpoint"); 
$length= $finish-$start;
$value=substr($value, $start, $length);

function i_denude($variable)
{
return(eregi_replace("<img src=[^>]*>", "", $variable));
}

function i_denudef($variable)
{
return(eregi_replace("<font[^>]*>", "", $variable));
}

$PHPrint = ("$value"); 

if ($stripImages == "yes") {
$PHPrint = i_denude("$PHPrint");
}

$PHPrint = i_denudef("$PHPrint");
$PHPrint = eregi_replace( "</font>", "", $PHPrint );
$PHPrint = stripslashes("$PHPrint"); 

// 
echo "<base href=\"$baseURL\">";

echo $PHPrint; 

echo "<br/><br/>Page printed from: <br />" . " $refpage ";

?>
