<?php
App::uses('CakeEmail', 'Network/Email');

class BirthdayNotificationShell extends AppShell {
    public function main() {
        $this->out('Happy Birthday '.$this->args[0]);
    }

    public $tasks = array('TemplateBirthday');    

    public function SendNotification() {
        $datas=$this->TemplateBirthday->execute();
        
            //$this->out(print_r($datas,true));
        
        foreach($datas as $key1=>$value1){
            //$this->out(print_r($value1,true));
            
            foreach($value1 as $key2=>$value2){
                $header=$this->TemplateBirthday->header($key2);
                $footer=$this->TemplateBirthday->footer();
                $content=$this->TemplateBirthday->content($value2);
                //$this->out(print_r($header,true));
                //$this->out(print_r($content,true));
                foreach($value2 as $em=>$emdet){
                    switch ($em){
                            case 'name':
                                $name=$emdet;
                            break;
                            case 'email':
                                $email=$emdet;
                            break;
                    }
                }
                $message_body=$header.$content.$footer;
                $Email = new CakeEmail('gmail');
                $Email->from('donotreply@Shiftmate.com' , 'Shiftmate');
                $Email->sender('donotreply@Shiftmate.com' , 'Shiftmate');
                $Email->to($email);
                $Email->emailFormat('html');
                $Email->subject('Birthday Notification');
               if($Email->send($message_body)){
                    $this->out('Send to : '.$email);
                }else{
                    $this->out('Failed to send Email to : '.$email);
                                   
                }               
               }
            }
        }
        
/*        $Email = new CakeEmail($gmail);
        //$Email->domain('www.example.org');
        $Email->from(array('me@example.com' => 'My Site'))
            ->sender('app@example.com', 'MyApp emailer')
            ->to('you@example.com')
            ->subject('About')
            ->send($message_body);
*/
    }
?>