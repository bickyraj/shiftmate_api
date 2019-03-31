<?php
App::uses('CakeEmail', 'Network/Email');

class CheckinNotificationShell extends AppShell {
    public $tasks = array('TemplateCheckin');
        
    public function main() {
        $data=$this->TemplateCheckin->execute();
        //$this->out(print_r($data,true));
       foreach($data as $key1=>$value1){
        foreach($value1 as $key2=>$value2){
            $header=$this->TemplateCheckin->header($key2);
            $footer=$this->TemplateCheckin->footer();
            $content=$this->TemplateCheckin->content($value2);
          //$this->out(print_r(array($key2=>$value2)));
                foreach($value2 as $em=>$emdet){
                    if($em == 'name'){
                        $name=$emdet;
                    }
                    if($em == 'email'){
                        $email=$emdet;
                    }
                }
                $message_body=$header.$content.$footer;
                $Email = new CakeEmail('gmail');
                $Email->from('donotreply@Shiftmate.com' , 'Shiftmate');
                $Email->sender('donotreply@Shiftmate.com' , 'Shiftmate');
                $Email->to($email);
                $Email->emailFormat('html');
                $Email->subject('Bir Notification');
               if($Email->send($message_body)){
                    $this->out('Send to : '.$email);
                }else{
                    $this->out('Failed to send Email to : '.$email);
                                   
                } 
        }
       }
    }
}
?>