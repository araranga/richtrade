<?php
session_start();
require_once("../connect.php");
require_once("../function.php");
$email  = $_POST['email'];


$q = mysql_query_md("SELECT * FROM tbl_betakey WHERE user IS NULL LIMIT 1");
$row = mysql_fetch_md_assoc($q);
$count = mysql_num_rows_md($q);




if(empty($email)){
	$count = 0;
}
if($count==1)
{
	echo 1;	
		
		
		
$mailtemplate = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional //EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
<head>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <meta name=\"x-apple-disable-message-reformatting\">
  <!--[if !mso]><!--><meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"><!--<![endif]-->
  <title></title>
  
    <style type=\"text/css\">
      @media only screen and (min-width: 620px) {
  .u-row {
    width: 600px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-100 {
    width: 600px !important;
  }

}

@media (max-width: 620px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: 100% !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors='true'] {
  color: inherit !important;
  text-decoration: none !important;
}

table, td { color: #000000; } #u_body a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_1 .v-src-width { width: auto !important; } #u_content_image_1 .v-src-max-width { max-width: 30% !important; } #u_content_button_1 .v-padding { padding: 13px 35px !important; } }
    </style>
  
  

<!--[if !mso]><!--><link href=\"https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><link href=\"https://fonts.googleapis.com/css?family=Lato:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><link href=\"https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap\" rel=\"stylesheet\" type=\"text/css\"><!--<![endif]-->

</head>

<body class=\"clean-body u_body\" style=\"margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #0f3242;color: #000000\">
  <!--[if IE]><div class=\"ie-container\"><![endif]-->
  <!--[if mso]><div class=\"mso-container\"><![endif]-->
  <table id=\"u_body\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #0f3242;width:100%\" cellpadding=\"0\" cellspacing=\"0\">
  <tbody>
  <tr style=\"vertical-align: top\">
    <td style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top\">
    <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td align=\"center\" style=\"background-color: #0f3242;\"><![endif]-->
    

<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">
  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #113c55;\">
    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">
      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: #113c55;\"><![endif]-->
      
<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\" valign=\"top\"><![endif]-->
<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">
  <div style=\"height: 100%;width: 100% !important;\">
  <!--[if (!mso)&(!IE)]><!--><div style=\"box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->
  
<table style=\"font-family:'Lato',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
  <tbody>
    <tr>
      <td style=\"overflow-wrap:break-word;word-break:break-word;padding:0px 0px 15px;font-family:'Lato',sans-serif;\" align=\"left\">
        
  <table height=\"0px\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 4px solid #af1127;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%\">
    <tbody>
      <tr style=\"vertical-align: top\">
        <td style=\"word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%\">
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>



<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">
  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #113c55;\">
    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">
      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: #113c55;\"><![endif]-->
      
<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\" valign=\"top\"><![endif]-->
<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">
  <div style=\"height: 100%;width: 100% !important;\">
  <!--[if (!mso)&(!IE)]><!--><div style=\"box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->
  
<table id=\"u_content_image_1\" style=\"font-family:'Lato',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
  <tbody>
    <tr>
      <td style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 10px 15px;font-family:'Lato',sans-serif;\" align=\"left\">
        
<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='background-color:white'>
  <tr>
    <td style=\"padding-right: 0px;padding-left: 0px;\" align=\"center\">
      
      <img align=\"center\" border=\"0\" src=\"https://pocketfighterz.com/logo.png\" alt=\"Image\" title=\"Image\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 20%;max-width: 116px;\" width=\"116\" class=\"v-src-width v-src-max-width\"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>



<div class=\"u-row-container\" style=\"padding: 0px;background-image: url('%20');background-repeat: no-repeat;background-position: center top;background-color: transparent\">
  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;\">
    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">
      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-image: url('%20');background-repeat: no-repeat;background-position: center top;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: transparent;\"><![endif]-->
      
<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\" valign=\"top\"><![endif]-->
<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">
  <div style=\"height: 100%;width: 100% !important;\">
  <!--[if (!mso)&(!IE)]><!--><div style=\"box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->
  
<table style=\"font-family:'Lato',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
  <tbody>
    <tr>
      <td style=\"overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:'Lato',sans-serif;\" align=\"left\">
        
<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
  <tr>
    <td style=\"padding-right: 0px;padding-left: 0px;\" align=\"center\">
      
      <img align=\"center\" border=\"0\" src=\"https://pocketfighterz.com/sprites/social/social.png\" alt=\"Image\" title=\"Image\" style=\"outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;\" width=\"600\" class=\"v-src-width v-src-max-width\"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>



<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">
  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #113c55;\">
    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">
      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: #113c55;\"><![endif]-->
      
<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\" valign=\"top\"><![endif]-->
<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">
  <div style=\"height: 100%;width: 100% !important;\">
  <!--[if (!mso)&(!IE)]><!--><div style=\"box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->
  
<table style=\"font-family:'Lato',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
  <tbody>
    <tr>
      <td style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 10px 15px;font-family:'Lato',sans-serif;\" align=\"left\">
        
  <div style=\"color: #ffffff; line-height: 150%; text-align: center; word-wrap: break-word;\">
    <p style=\"font-size: 14px; line-height: 150%;\"><span style=\"font-family: Raleway, sans-serif; font-size: 14px; line-height: 21px;\"><span style=\"font-size: 26px; line-height: 39px;\">YOUR BETAKEY</span></p>
<p style=\"font-size: 14px; line-height: 150%;\"><strong><span style=\"font-family: Raleway, sans-serif; font-size: 14px; line-height: 21px;\"><span style=\"font-size: 26px; line-height: 39px;\">{$row['betakey']}</span></span></strong></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>



<table style=\"font-family:'Lato',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
  <tbody>
    <tr>
      <td style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 40px 40px;font-family:'Lato',sans-serif;\" align=\"left\">
        
  <div style=\"color: #ffffff; line-height: 150%; text-align: center; word-wrap: break-word;\">
    <p style=\"font-size: 14px; line-height: 150%;\"><span style=\"font-family: Lato, sans-serif; font-size: 14px; line-height: 21px;\">Use code Above to register on our site ;) Happy Grinding </span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>



  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>



<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">
  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #113c55;\">
    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">
      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: #113c55;\"><![endif]-->
      
<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\" valign=\"top\"><![endif]-->
<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">
  <div style=\"height: 100%;width: 100% !important;\">
  <!--[if (!mso)&(!IE)]><!--><div style=\"box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->
 
  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>



<div class=\"u-row-container\" style=\"padding: 0px;background-color: transparent\">
  <div class=\"u-row\" style=\"Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #153257;\">
    <div style=\"border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;\">
      <!--[if (mso)|(IE)]><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td style=\"padding: 0px;background-color: transparent;\" align=\"center\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:600px;\"><tr style=\"background-color: #153257;\"><![endif]-->
      
<!--[if (mso)|(IE)]><td align=\"center\" width=\"600\" style=\"width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\" valign=\"top\"><![endif]-->
<div class=\"u-col u-col-100\" style=\"max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;\">
  <div style=\"height: 100%;width: 100% !important;\">
  <!--[if (!mso)&(!IE)]><!--><div style=\"box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;\"><!--<![endif]-->
  
<table style=\"font-family:'Lato',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
  <tbody>
    <tr>
      <td style=\"overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Lato',sans-serif;\" align=\"left\">
        

      </td>
    </tr>
  </tbody>
</table>

<table style=\"font-family:'Lato',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
  <tbody>
    <tr>
      <td style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 30px;font-family:'Lato',sans-serif;\" align=\"left\">
        


      </td>
    </tr>
  </tbody>
</table>

<table style=\"font-family:'Lato',sans-serif;\" role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">
  <tbody>
    <tr>
      <td style=\"overflow-wrap:break-word;word-break:break-word;padding:10px 20px 15px;font-family:'Lato',sans-serif;\" align=\"left\">
        
  <div style=\"color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;\">
    <p style=\"font-size: 14px; line-height: 140%;\"><span style=\"font-size: 12px; line-height: 16.8px;\">Pocket FighterZ. </span></p>
<p style=\"font-size: 14px; line-height: 140%;\"><span style=\"font-size: 12px; line-height: 16.8px;\">&copy;&nbsp; All rights reserved. </span><br /></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
  </div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
    </div>
  </div>
</div>


    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
    </td>
  </tr>
  </tbody>
  </table>
  <!--[if mso]></div><![endif]-->
  <!--[if IE]></div><![endif]-->
</body>

</html>
";		
		
		
		
		
		
		
$to = $_POST['email'];
$subject = "PocketFighterz - Beta Keys";
$txt = "Here is your betakey:  ".$row['betakey'];



// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From: noreply@pocketfighters.com" . "\r\n" .
"CC: ardeenathanraranga@gmail.com";

mail($to,$subject,$mailtemplate,$headers);

}
if($count==0)
{
	echo $count;	
}
?>