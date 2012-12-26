<?php
namespace app\controllers;

use app\extensions\action\Oauth2;
use app\models\Users;
use app\models\Details;

use lithium\security\Auth;
use lithium\storage\Session;
use app\models\Functions;
use MongoID;

class UsersController extends \lithium\action\Controller {

	public function index(){
//		$users = Users::all();
//		return compact('users');
	}
	public function signup() {	
		$user = Users::create();

		if(($this->request->data) && $user->save($this->request->data)) {	
			$data = array('user_id'=>$user->_id,'email.verify' => sha1($user->_id));
			Details::create()->save($data);exit;
			$this->sendverificationemail($user);
			$this->redirect('Users::email');	
		}
		return compact(array('user'));
	}
	public function login() {
		if ($this->request->data && Auth::check('member', $this->request)) {
			return $this->redirect('Users::index');	
		}
	}
	public function logout() {	
		Auth::clear('member');
		return $this->redirect('Users::index');
	}

	public function email(){
		$user = Session::read('member');
		$id = $user['_id'];
		$details = Details::find('first',
			array('conditions'=>array('user_id'=>$id))
		);

		if(isset($details['email']['verified'])){
			$msg = "Your email is verified.";
		}else{
			$msg = "Your email is <strong>not</strong> verified. Please check your email to verify.";
			
		}
		return compact('msg');
	}
	public function settings() {
		$user = Session::read('default');
		$id = $user['_id'];
		
		$details = Details::find('first',
			array('conditions'=>array('user_id'=>$id))
		);

	return compact('details','user');
		
	}

public function settings_keys(){		
		$user = Session::read('default');
		$id = $user['_id'];

		$details = Details::find('first',
			array('conditions'=>array('user_id'=>$id))
		);
		if(!isset($details['key'])){
			$oa = new Oauth2();
			$data = $oa->request_token();
			$details = Details::find('all',
				array('conditions'=>array('user_id'=>$id))
			)->save($data);
		}
		$details = Details::find('first',
			array('conditions'=>array('user_id'=>$id))
		);
	return compact('details');
}

	
	public function confirm($email=null,$id=null){
		if($email == "" || $id==""){

			if($this->request->data){
				if($this->request->data['email']=="" || $this->request->data['verified']==""){
					return $this->redirect('Users::email');
				}
				$email = $this->request->data['email'];
				$id = $this->request->data['verified'];
			}else{return $this->redirect('Users::email');}
		}
	$finduser = Users::first(array(
		'conditions'=>array(
			'email' => $email,
			'_id' => $id
		)
	));
	$id = sha1((string) $finduser['_id']);
		if($id!=null){
			$data = array('email.verified'=>'Yes','user_id'=>$id);
			Details::create();
			$details = Details::find('all',array(
				'conditions'=>array('user_id'=>$id)
			))->save($data);
			if(count($details)==0){
				Details::create($data)->save($data);
			}
			return compact('id');
		}else{return $this->redirect('Users::email');}
	}
	
	public function mobile(){
		$user_id = $this->request->data['user_id'];
		if($this->request->data){
			Details::find('all',array(
				'conditions'=>array('user_id'=>$user_id)
			))->save($this->request->data);

		}
	}
	
	public function addbank(){
		$user = Session::read('default');
		$user_id = $user['_id'];
		$details = Details::find('all',array(
				'conditions'=>array('user_id'=>$user_id)
			));		
		return compact('details');
	}
	
	public function addbankdetails(){
		$user = Session::read('default');
		$user_id = $user['_id'];
		$data = array();
		if($this->request->data) {	
			$data['bank'] = $this->request->data;
			$data['bank']['id'] = new MongoID;
			$data['bank']['verified'] = 'No';
			Details::find('all',array(
				'conditions'=>array('user_id'=>$user_id)
			))->save($data);
		}
		return $this->redirect('Users::settings');
	}
	public function sendverificationemail($user,$verification){
	$to = $user['email'];
	$subject = "Verification of email from rbitco.in";
	
	$message = 'Hi,

Please confirm your email address associated at rbitco.in by clicking the following link:

http://rbitco.in/users/confirm/'.$user['email'].'/'.$verification.'

Or use this confirmation code: '.$verification.' for email address: '.$user['email'].'

Thanks
Support rBitcoin
';
		$from = 'no-reply@rbitco.in';
		$headers = "From:" . $from;

		mail($to,$subject,$message,$headers);
//		exit;
		return;

	}
}
?>