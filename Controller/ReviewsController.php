<?php
App::uses('AppController', 'Controller');

class ReviewsController extends AppController {
 /**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'RequestHandler');
    
    
    public function saveReview(){
        if ($this->RequestHandler->requestedWith('json') || $this->request->is('post') || $this->request->is('put')) {
            $data=$this->request->data;
            $message1 = $this->Review->saveReview($data);
            
            $this->set(array(
            'message'=>$message1,
            '_serialize'=>array('message')
            ));
        }
    }
    
        public function myReviews($type,$user_id,$org_id,$branch_id,$page){
            $myReview = $this->Review->myReview($type,$user_id,$org_id,$branch_id,$page);
            $this->set(array(
                    'myReview' => $myReview,
                    '_serialize' => array('myReview')              
            ));
    }
    public function sentReviews($user_id,$org_id,$page){
            $sentReview = $this->Review->sentReview($user_id,$org_id,$page);
            $this->set(array(
                    'sentReview' => $sentReview,
                    '_serialize' => array('sentReview')              
            ));
    }
    
    public function sentAllReviews($org_id,$page){
        $sentAllReview = $this->Review->sentAllReview($org_id,$page);
            $this->set(array(
                    'sentAllReview' => $sentAllReview,
                    '_serialize' => array('sentAllReview')              
            ));
    }

    public function filterReview($orgId,$name,$branchId,$departmentId){
        $output = $this->Review->filterReview($orgId,$name,$branchId,$departmentId);
        
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
            ));
    }

    public function viewMyReview($userId,$page){
        $limit = 10;
        $result = $this->Review->viewMyReview($userId,$page,$limit);
        
        $count = $this->Review->countReview($userId);
        $maxPage = ceil($count/$limit);
        $this->set(array(
            "result"=>$result,
            "page"=>$page,
            "maxPage"=>$maxPage,
            "_serialize"=>array("result","page","maxPage"),
            "_jsonp"=>true
        )); 
    }
    
    public function reviewById($reviewId = null,$status = null){
        $output = $this->Review->reviewById($reviewId);
        if($status != null){
            $this->updateReviewStatus($reviewId,$status);
        }
        
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
            ));
    }
   
   public function updateReviewStatus($reviewId = null ,$status = null){
        $this->Review->id = $reviewId;
        
        $result = $this->Review->find('first',array(
                'recursive'=>-1,
                'conditions'=>array('Review.id'=>$reviewId)
            ));

        
        $this->request->data['Review']['status'] = $status;
        
        $output['status'] = 0;

        if($result['Review']['status'] != 1){
            if($this->Review->save($this->request->data)){
                $output['status'] = 1;//updated
            } 
        }
        $this->set(array(
                'output'=>$output,
                '_serialize'=>'output'
            ));
   }
 }