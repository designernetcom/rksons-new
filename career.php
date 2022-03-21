<?php
$statusMsg='';
if(isset($_FILES["file"]["name"])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $education = $_POST['education'];
    $experience = $_POST['experience']; 
    $current = $_POST['current'];
    $message = $_POST['message'];
$fromemail =  $email;
$subject="Uploaded file attachment";
$email_message = '<h2>Application Request for Job</h2>
                    <p><b>Name:</b> '.$name.'</p>
                    <p><b>Email:</b> '.$email.'</p>
                    <p><b>Phone:</b> '.$phone.'</p>
                    <p><b>Subject:</b> '.$subject.'</p>
                    <p><b>Qualification:</b> '.$education.'</p>
                    <p><b>Experience:</b> '.$experience.'</p> 
                    <p><b>CurrentCTC:</b> '.$current.'</p>
                    <p><b>Message:</b><br/>'.$message.'</p>';
$email_message.="Please find the attachment";
$semi_rand = md5(uniqid(time()));
$headers = "From: ".$fromemail;
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
 
    $headers .= "\nMIME-Version: 1.0\n" .
    "Content-Type: multipart/mixed;\n" .
    " boundary=\"{$mime_boundary}\"";
 
if($_FILES["file"]["name"]!= ""){  
$strFilesName = $_FILES["file"]["name"];  
$strContent = chunk_split(base64_encode(file_get_contents($_FILES["file"]["tmp_name"])));  
    $email_message .= "This is a multi-part message in MIME format.\n\n" .
    "--{$mime_boundary}\n" .
    "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" .
    $email_message .= "\n\n";
 
 
    $email_message .= "--{$mime_boundary}\n" .
    "Content-Type: application/octet-stream;\n" .
    " name=\"{$strFilesName}\"\n" .
    //"Content-Disposition: attachment;\n" .
    //" filename=\"{$fileatt_name}\"\n" .
    "Content-Transfer-Encoding: base64\n\n" .
    $strContent  .= "\n\n" .
    "--{$mime_boundary}--\n";
}
$toemail="info@rksons.in, sales@rksons.in, sales@netcom-india.com";

 if(mail($toemail, $subject, $email_message, $headers)){
   header("Location:thanks.html");
}else{
   $statusMsg= "Not sent";
}
}
   ?>