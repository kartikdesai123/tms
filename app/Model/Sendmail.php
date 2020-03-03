<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use Config;
use Illuminate\Support\Facades\DB;
use Mail;

class Sendmail extends Model 
{
    
    public function sendMailltesting(){
            $mailData['data']='';
            $mailData['subject'] = 'Send Mail testing';
            $mailData['attachment'] = array();
            $mailData['template'] ="emails.test";
            $mailData['mailto'] = 'parthkhunt12@gmail.com';
            $sendMail = new Sendmail;
            return $sendMail->sendSMTPMail($mailData);
    }
    
    public function sendMailalert($employeearray){
            $mailData['data']='';
            $mailData['subject'] = 'List Of End Contract Worker';
            $mailData['attachment'] = array();
            $mailData['template'] ="emails.alert_mail";
            $mailData['data']=$employeearray;
            $mailData['mailto'] = 'parthkhunt12@gmail.com';
            $sendMail = new Sendmail;
            return $sendMail->sendSMTPMail($mailData);
    }

    public function sendSMTPMail($mailData)
  {
      
            $pathToFile = $mailData['attachment'];
           
            $mailsend = Mail::send($mailData['template'], ['data' => $mailData['data']], function ($m) use ($mailData,$pathToFile) {
                 $m->from('officetestg106@gmail.com', 'TMS Systeam');
      
                 $m->to($mailData['mailto'], "TMS Systeam")->subject($mailData['subject']);
                 if($pathToFile != ""){
                     // $m->attach($pathToFile);
                 }
                 
                //  $m->cc($mailData['bcc']);
             });
             if($mailsend){
                 return true;
             }else{
                 return false;
             }
  }
}