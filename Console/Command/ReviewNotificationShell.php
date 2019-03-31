<?php
App::uses('CakeEmail', 'Network/Email');

class ReviewNotificationShell extends AppShell {
    public $tasks = array('TemplateReview');
     public function main() {
        $datas=$this->TemplateReview->execute();
        if(isset($datas) && !empty($datas)){
            foreach($datas as $data){
                $header = $this->TemplateReview->header($data['org']);
                $footer = $this->TemplateReview->footer();
                $content = $this->TemplateReview->content($data['user']);
                if($data['org']['email'] != ""){
                    $message_body=$header.$content.$footer;
                    $Email = new CakeEmail();
                    $Email->from('donotreply@Shiftmate.com' , 'Shiftmate');
                    $Email->sender('donotreply@Shiftmate.com' , 'Shiftmate');
                    $Email->to($data['org']['email']);
                    $Email->emailFormat('html');
                    $Email->subject('Review Notification of SHIFTMATE');
                   if($Email->send($message_body)){
                        $this->TemplateReview->manageDates($data['user']);
                        $this->out('Send to : '.$data['org']['email']);
                    }else{
                        $this->out('Failed to send Email to : '.$data['org']['email']);
                                       
                    }
                }
	}
            }
        }
    }

?>