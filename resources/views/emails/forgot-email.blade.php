<!-- <!doctype html> -->
<html>
<head>
<title></title>
<style type="text/css">
/* CLIENT-SPECIFIC STYLES */
body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
img { -ms-interpolation-mode: bicubic; }

/* RESET STYLES */
img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
table { border-collapse: collapse !important; }
body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

/* iOS BLUE LINKS */
a[x-apple-data-detectors] {
   color: inherit !important;
   text-decoration: none !important;
   font-size: inherit !important;
   font-family: inherit !important;
   font-weight: inherit !important;
   line-height: inherit !important;
}

/* MOBILE STYLES */
@media screen and (max-width: 600px) {
 .img-max {
   width: 100% !important;
   max-width: 100% !important;
   height: auto !important;
 }

 .max-width {
   max-width: 100% !important;
 }

 .mobile-wrapper {
   width: 85% !important;
   max-width: 85% !important;
 }

 .mobile-padding {
   padding-left: 5% !important;
   padding-right: 5% !important;
 }
}

/* ANDROID CENTER FIX */
div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>

<body style="margin: 0 !important; padding: 0 !important; background-color: #F1F1F1;" bgcolor="#F1F1F1">

<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
   Herzlich Willkommen bei Office Park Telefonservice. 
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
   <tr>
       <td align="center" valign="top" width="100%" bgcolor="#FFFFFF" style="background: #F9F9F9 ; background-size: cover; background-attachment: fixed; padding: 50px 15px 0 15px;" class="mobile-padding">
           <!--[if (gte mso 9)|(IE)]>
           <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
           <tr>
           <td align="center" valign="top" width="600">
           <![endif]-->
           <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
               <tr>
                   <td align="center" valign="top" style="padding: 0 0 50px 0;">
                       <img src="{{ URL::asset('img/mvc_logo.png') }}" width="250" height="145" border="0" style="display: block;">
                   </td>
               </tr>
               <tr>
                   <td align="left" valign="top" style="padding: 50px; font-family: Open Sans, Helvetica, Arial, sans-serif; border-radius: 3px; " bgcolor="#ffffff">
                       <p style="color: #999999; font-size: 16px; line-height: 26px; margin: 0;">

                           	Dear {{ $data['name'] }},<br><br>
                           
                           	Recently, you've applied forgot password for your Human Resource & Payroll Management System. Your new password is: <b>{{ $data['password'] }}</b> <br><br>

                                Thanks, <br>
                                HRMS Team.
                          
                            <!-- Mit freundlichen Grüßen,<br> -->
                           <!-- <img src="images/signatur.png" width="130" height="168" style="display: block; border: 0px;"/> -->
                           <!-- Baris Ak <br>
Geschäftsführer<br> -->
                       </p>
                   </td>
               </tr>
               <tr>
                   <td align="center" valign="top" style="padding: 25px 0; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #000;">
                       <p style="font-size: 14px; line-height: 20px;color:#999999">
                          Office Park GbR<br>
                          Münsterstr. 330<br>
                          40470 Düsseldorf

                         <br><br>
                         <!-- <a href="#" style="color: #999999;" target="_blank">Datenschutz </a>
                         &nbsp; &bull; &nbsp;
                         <a href="#" style="color: #999999;" target="_blank">Impressum</a>
                         &nbsp; &bull; &nbsp;
                         <a href="#" style="color: #999999;" target="_blank">Kontakt</a> -->
                       </p>
                   </td>
               </tr>
           </table>
           <!--[if (gte mso 9)|(IE)]>
           </td>
           </tr>
           </table>
           <![endif]-->
       </td>
   </tr>
</table>
</body>
</html>
