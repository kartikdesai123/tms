
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
    List Of end Contract worker
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
   <tr>
       <td align="center" valign="top" width="100%" bgcolor="#FFFFFF" style="background: #F9F9F9 ; background-size: cover; background-attachment: fixed; padding: 50px 15px 0 15px;" class="mobile-padding">
           
           <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" >
               <tr>
                   <td align="center" valign="top" style="padding: 0 0 50px 0;">
                       
                       <img src="{{ URL::asset('img/logo.png') }}" width="250" height="145" border="0" style="display: block;">
                   </td>
               </tr>
               <tr>
                   <td align="left" valign="top" style="padding: 50px; font-family: Open Sans, Helvetica, Arial, sans-serif; border-radius: 3px; " bgcolor="#ffffff">
                      <table align="center" border="1" cellpadding="0" cellspacing="0" width="100%" >
                           <thead>
                               <tr>
                                   <th>Id</th>
                                   <th>Staff Number</th>
                                   <th>Name</th>
                                   <th>Surname</th>
                                   <th>End Contract Date</th>
                               </tr>
                           </thead>
                           <tbody>
                               @for($i = 0 ; $i < count($data) ; $i++)
                               <tr>
                                   <td align="center" valign="top" >{{ $data[$i]->id }}</td>
                                   <td align="center" valign="top" >{{ $data[$i]->staffnumber }}</td>
                                   <td align="center" valign="top" >{{ $data[$i]->name }}</td>
                                   <td align="center" valign="top" >{{ $data[$i]->surname }}</td>
                                   <td align="center" valign="top" >{{ date("d-m-Y h:i:s",strtotime($data[$i]->endContract)) }}</td>
                               </tr>
                               @endfor
                           </tbody>
                       </table>
                   </td>
               </tr>
           </table>
       </td>
   </tr>
</table>
</body>
</html>
