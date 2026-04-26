<?php 
/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends SecureController{
	function __construct(){
		parent::__construct(); 
		$this->tablename = "members";
	}
	/**
		* Index Action
		* @return null
		*/
	function index(){
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID; //get current user id from session
		$db->where ("id", $rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"membership_no", 
			"first_name", 
			"last_name", 
			"phone", 
			"email", 
			"gender", 
			"date_of_birth", 
			"marital_status", 
			"family_id", 
			"residence_location", 
			"residence_city", 
			"residence_area", 
			"baptism_date", 
			"membership_date", 
			"role", 
			"created_at", 
			"updated_at", 
			"username");
		$user = $db->getOne($tablename , $fields);
		if(!empty($user)){
			$page_title = $this->view->page_title = "My Account";
			$this->render_view("account/view.php", $user);
		}
		else{
			$this->set_page_error();
			$this->render_view("account/view.php");
		}
	}
	/**
     * Update user account record with formdata
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","membership_no","first_name","last_name","phone","gender","date_of_birth","marital_status","family_id","residence_location","residence_city","residence_area","baptism_date","membership_date","role","profile_photo","username");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'membership_no' => 'required',
				'first_name' => 'required',
				'last_name' => 'required',
				'phone' => 'required',
				'gender' => 'required',
				'date_of_birth' => 'required',
				'marital_status' => 'required|numeric',
				'family_id' => 'required|numeric',
				'residence_location' => 'required',
				'residence_city' => 'required',
				'residence_area' => 'required',
				'baptism_date' => 'required',
				'membership_date' => 'required',
				'role' => 'required',
				'profile_photo' => 'required',
				'username' => 'required',
			);
			$this->sanitize_array = array(
				'membership_no' => 'sanitize_string',
				'first_name' => 'sanitize_string',
				'last_name' => 'sanitize_string',
				'phone' => 'sanitize_string',
				'gender' => 'sanitize_string',
				'date_of_birth' => 'sanitize_string',
				'marital_status' => 'sanitize_string',
				'family_id' => 'sanitize_string',
				'residence_location' => 'sanitize_string',
				'residence_city' => 'sanitize_string',
				'residence_area' => 'sanitize_string',
				'baptism_date' => 'sanitize_string',
				'membership_date' => 'sanitize_string',
				'role' => 'sanitize_string',
				'profile_photo' => 'sanitize_string',
				'username' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['membership_no'])){
				$db->where("membership_no", $modeldata['membership_no'])->where("id", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['membership_no']." Already exist!";
				}
			} 
			if($this->validated()){
				$db->where("members.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					$db->where ("id", $rec_id);
					$user = $db->getOne($tablename , "*");
					set_session("user_data", $user);// update session with new user data
					return $this->redirect("account");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$this->set_flash_msg("No record updated", "warning");
						return	$this->redirect("account");
					}
				}
			}
		}
		$db->where("members.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "My Account";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("account/edit.php", $data);
	}
	/**
     * Change account email
     * @return BaseView
     */
	function change_email($formdata = null){
		if($formdata){
			$email = trim($formdata['email']);
			$db = $this->GetModel();
			$rec_id = $this->rec_id = USER_ID; //get current user id from session
			$tablename = $this->tablename;
			$db->where ("id", $rec_id);
			$result = $db->update($tablename, array('email' => $email ));
			if($result){
				$this->set_flash_msg("Email address changed successfully", "success");
				$this->redirect("account");
			}
			else{
				$this->set_page_error("Email not changed");
			}
		}
		return $this->render_view("account/change_email.php");
	}
}
