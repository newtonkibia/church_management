<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * members_membership_no_value_exist Model Action
     * @return array
     */
	function members_membership_no_value_exist($val){
		$db = $this->GetModel();
		$db->where("membership_no", $val);
		$exist = $db->has("members");
		return $exist;
	}

	/**
     * members_email_value_exist Model Action
     * @return array
     */
	function members_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("members");
		return $exist;
	}

}
