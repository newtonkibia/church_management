<?php 
/**
 * Members Page Controller
 * @category  Controller
 */
class MembersController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "members";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
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
			"profile_photo", 
			"created_at", 
			"updated_at", 
			"username");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				members.id LIKE ? OR 
				members.membership_no LIKE ? OR 
				members.first_name LIKE ? OR 
				members.last_name LIKE ? OR 
				members.phone LIKE ? OR 
				members.email LIKE ? OR 
				members.gender LIKE ? OR 
				members.date_of_birth LIKE ? OR 
				members.marital_status LIKE ? OR 
				members.family_id LIKE ? OR 
				members.residence_location LIKE ? OR 
				members.residence_city LIKE ? OR 
				members.residence_area LIKE ? OR 
				members.baptism_date LIKE ? OR 
				members.membership_date LIKE ? OR 
				members.role LIKE ? OR 
				members.profile_photo LIKE ? OR 
				members.created_at LIKE ? OR 
				members.updated_at LIKE ? OR 
				members.username LIKE ? OR 
				members.password LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "members/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("members.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Members";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("members/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
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
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("members.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Members";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("members/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("membership_no","first_name","last_name","phone","email","gender","date_of_birth","marital_status","family_id","residence_location","residence_city","residence_area","baptism_date","membership_date","role","profile_photo","username","password");
			$postdata = $this->format_request_data($formdata);
			$cpassword = $postdata['confirm_password'];
			$password = $postdata['password'];
			if($cpassword != $password){
				$this->view->page_error[] = "Your password confirmation is not consistent";
			}
			$this->rules_array = array(
				'membership_no' => 'required',
				'first_name' => 'required',
				'last_name' => 'required',
				'phone' => 'required',
				'email' => 'required|valid_email',
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
				'password' => 'required',
			);
			$this->sanitize_array = array(
				'membership_no' => 'sanitize_string',
				'first_name' => 'sanitize_string',
				'last_name' => 'sanitize_string',
				'phone' => 'sanitize_string',
				'email' => 'sanitize_string',
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
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$password_text = $modeldata['password'];
			//update modeldata with the password hash
			$modeldata['password'] = $this->modeldata['password'] = password_hash($password_text , PASSWORD_DEFAULT);
			//Check if Duplicate Record Already Exit In The Database
			$db->where("membership_no", $modeldata['membership_no']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['membership_no']." Already exist!";
			}
			//Check if Duplicate Record Already Exit In The Database
			$db->where("email", $modeldata['email']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['email']." Already exist!";
			} 
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("members");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Members";
		$this->render_view("members/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
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
					return $this->redirect("members");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("members");
					}
				}
			}
		}
		$db->where("members.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Members";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("members/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id","membership_no","first_name","last_name","phone","gender","date_of_birth","marital_status","family_id","residence_location","residence_city","residence_area","baptism_date","membership_date","role","profile_photo","username");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
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
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
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
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("members.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("members");
	}
}
