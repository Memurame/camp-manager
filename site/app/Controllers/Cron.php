<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PersonModel;
use App\Models\LogModel;
use Couchbase\User;

class Cron extends BaseController
{
    public function mail()
    {
        $directory = FCPATH . '../writable/mail/';
        $directory_queue = $directory . 'queue/';
        $directory_done = $directory . 'done/';
        $scanned_directory = array_diff(scandir($directory_queue), array('..', '.', 'index.html'));

        foreach($scanned_directory as $file){
            $json = json_decode(file_get_contents($directory_queue . $file), true);
            if($json['typ'] == 'form'){

                $logModel = new LogModel();
                foreach($json['to'] as $mail){

                    if($mail){
                        $email = \Config\Services::email();

                        $email->setFrom(settings()->read('email.fromMail'), settings()->read('email.fromName'));
                        if(!empty($json['reply_to'])){
                            $email->setReplyTo($json['reply_to']);
                        }
                        $email->setTo($mail);

                        $email->setSubject($json['subject']);
                        $email->setMessage(view('email/sendmail.php', [
                            'betreff' => $json['subject'],
                            'text' => $json['text']
                        ]));

                        $email->send();

                        $log = [
                            'uid' => $json['uid'],
                            'v1' => $mail,
                            'v2' => $json['time'],
                            'msg' => 'E-Mail versendet.'
                        ];
                        $logModel->mail('success', $log);
                    }

                }
            }
            $json['sent'] = time();
            file_put_contents($directory_done . $json['time'] .'.json', json_encode($json));
            unlink($directory_queue . $file);


        }




    }
}
