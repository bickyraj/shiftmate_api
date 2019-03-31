<?php
App::uses('AppModel', 'Model');
/**
 * Review Model
 *
 * @property User $User
 * @property Org $Org
 * @property Board $Board
 * @property Branch $Branch
 */
class Review extends AppModel {

/**
 * Display field
 *
 * @var string
 */
//	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'reviewby' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'organization_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
/*		'board_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
*/
		'branch_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'details' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
/*		'reviewdate' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
  */
		'reviewtype' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
/*		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
  */
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Board' => array(
			'className' => 'Board',
			'foreignKey' => 'board_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Branch' => array(
			'className' => 'Branch',
			'foreignKey' => 'branch_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    
    public function saveReview($data){
            $this->create();
            $data['Review']['status']='0';
        
            if($this->save($data)){
                if($data['Review']['reviewtype']=="written_warning"){
                    $to = 'oneplatinum.nepal@gmail.com';
                    $subject = "Shiftmate : Warming";
                    $message = $data['Review']['details'];
                    $headers = 'From: info@shiftmate.com' . "\r\n" .'X-Mailer: PHP/' . phpversion();
                    mail($to, $subject, $message, $headers);
                }
                return "Successfully saved";
            }else{
                return "Not saved";
            }
    }
    
    public function myReview($type,$user_id,$org_id,$branch_id,$pages){
        $limit=10;
        $myReviews['pages']=$pages;
        $myReviews['datas']=$this->find('all', array('conditions'=>array('Review.user_id'=>$user_id,'Review.organization_id'=>$org_id,'Review.branch_id'=>$branch_id,'Review.reviewtype'=>$type),'limit'=>$limit,'page'=>$pages,'order' => array('Review.reviewdate DESC'),'recursive'=>0));
        $myReviews['counts']=$this->find('count', array('conditions'=>array('Review.user_id'=>$user_id,'Review.organization_id'=>$org_id,'Review.branch_id'=>$branch_id,'Review.reviewtype'=>$type),'order' => array('Review.reviewdate DESC'),'recursive'=>0));
        $myReviews['limit']=$limit;
        return $myReviews;
    }
    
    public function sentReview($user_id,$org_id,$pages){
        $limit=10;
        $sentReviews['pages']=$pages;
        $sentReviews['datas']=$this->find('all', array('conditions'=>array('Review.user_id'=>$user_id,'Review.organization_id'=>$org_id),'limit'=>$limit,'page'=>$pages,'order' => array('Review.reviewdate DESC'),'recursive'=>0));
        $sentReviews['counts']=$this->find('count', array('conditions'=>array('Review.user_id'=>$user_id,'Review.organization_id'=>$org_id),'order' => array('Review.reviewdate DESC'),'recursive'=>0));
        $sentReviews['limit']=$limit;
        return $sentReviews;
    }
    public function sentAllReview($org_id,$pages){
        $limit=10;
        $sentAllReviews['pages']=$pages;
        $sentAllReviews['datas']=$this->find('all', array('conditions'=>array('Review.organization_id'=>$org_id),'limit'=>$limit,'page'=>$pages,'order' => array('Review.reviewdate DESC'),'recursive'=>0));
        $sentAllReviews['counts']=$this->find('count', array('conditions'=>array('Review.organization_id'=>$org_id),'order' => array('Review.reviewdate DESC'),'recursive'=>0));
        $sentAllReviews['limit']=$limit;
        return $sentAllReviews;
    }

    public function filterReview($orgId = null,$name = null,$branchId = null,$departmentId = null){
    	$this->Behaviors->load('Containable');
    	$names = explode(" ",$name);
        
        $contain = array('User'=>['fields'=>array('id','fname','lname','email','address','phone','image_dir','image','gender','status','imagepath')],'Branch'=>['fields'=>array('title')],'Board');


        if($name == '0' && $departmentId == '0' && $branchId != '0'){

            $conditions = array('Review.organization_id'=>$orgId,'Review.branch_id'=>$branchId);

        } else if($branchId == '0' && $name != '0'){
            foreach($names as $n){
                if(!empty($n)){
                	$OR = array();
                    $OR = ['User.fname LIKE' => '%'.$n.'%','User.lname LIKE' => '%'.$n.'%'];
                    $conditions[] = array('Review.organization_id'=>$orgId,"OR"=>$OR);
                }    
            }
        } else if($branchId != '0' && $name != '0' && $departmentId == '0'){

            foreach($names as $n){
                if(!empty($n)){
                	$OR = array();
                    $OR = ['User.fname LIKE' => '%'.$n.'%','User.lname LIKE' => '%'.$n.'%'];
                    $conditions[] = array('Review.organization_id'=>$orgId,'Review.branch_id'=>$branchId,"OR"=>$OR);
                }    
            }
        } else if($branchId != '0' && $departmentId != '0' && $name == '0' ){
            
            $conditions = array('Review.organization_id'=>$orgId,'Review.branch_id'=>$branchId,'Review.board_id'=>$departmentId);
       
        } else if($branchId != '0' && $departmentId != '0' && $name != '0'){

            foreach($names as $n){
                if(!empty($n)){
                	$OR = array();
                    $OR = ['User.fname LIKE' => '%'.$n.'%','User.lname LIKE' => '%'.$n.'%'];
                    $conditions[] = array('Review.organization_id'=>$orgId,'Review.branch_id'=>$branchId,"OR"=>$OR,'Review.board_id'=>$departmentId);
                }    
            }

        }

        $results = $this->find('all',array(
        	'conditions'=>$conditions,
        	'contain'=>$contain
        	));
        //debug($results);
        return $results;
    }

    public function viewMyReview($userId =null ,$page = null,$limit = null){
        $this->Behaviors->load('Containable');
        $conditions = array('Review.user_id'=>$userId);
        $contain = array('Organization'=>['fields'=>['id','title']],'Board'=>['fields'=>['id','title']],'Branch'=>['fields'=>['id','title']],'User'=>['fields'=>['id','fname','lname']]);
       	$myReviews = $this->find('all',array(
			'conditions'=>$conditions,
	       	'contain'=>$contain,
	       	'fields'=>array('id','reviewtype','reviewdate','status'),
	       	'limit'=>$limit,
	       	'page'=>$page
       		)
       	);
        return $myReviews;
    }

    public function countReview($userId){
    	$conditions = array('Review.user_id'=>$userId);
    	return $this->find("count",array(
    			'conditions'=>$conditions
    		));
    }

    public function reviewById($reviewId){
        $this->Behaviors->load('Containable');
        $contain = array('Organization'=>['fields'=>['id','title']],'Board'=>['fields'=>['id','title']],'Branch'=>['fields'=>['id','title']],'User'=>['fields'=>['id','fname','lname']]);
    	return $this->find('first',array(
    			'conditions'=>array('Review.id'=>$reviewId),
    			'contain'=>$contain,
    			'fields'=>array('id','details','status')
    		));
    }
    
}
