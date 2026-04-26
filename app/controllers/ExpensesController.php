<?php 
/**
 * Expenses Page Controller
 * @category  Controller
 */
class ExpensesController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "expenses";
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
			"category_id", 
			"description", 
			"amount", 
			"expense_date", 
			"payment_method", 
			"receipt_url", 
			"approved_by", 
			"entered_by", 
			"created_at");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				expenses.id LIKE ? OR 
				expenses.category_id LIKE ? OR 
				expenses.description LIKE ? OR 
				expenses.amount LIKE ? OR 
				expenses.expense_date LIKE ? OR 
				expenses.payment_method LIKE ? OR 
				expenses.receipt_url LIKE ? OR 
				expenses.approved_by LIKE ? OR 
				expenses.entered_by LIKE ? OR 
				expenses.created_at LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "expenses/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("expenses.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Expenses";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("expenses/list.php", $data); //render the full page
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
			"category_id", 
			"description", 
			"amount", 
			"expense_date", 
			"payment_method", 
			"receipt_url", 
			"approved_by", 
			"entered_by", 
			"created_at");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("expenses.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Expenses";
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
		return $this->render_view("expenses/view.php", $record);
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
			$fields = $this->fields = array("category_id","description","amount","expense_date","payment_method","receipt_url","approved_by","entered_by");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'category_id' => 'required|numeric',
				'description' => 'required',
				'amount' => 'required|numeric',
				'expense_date' => 'required',
				'payment_method' => 'required',
				'receipt_url' => 'required',
				'approved_by' => 'required|numeric',
				'entered_by' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'category_id' => 'sanitize_string',
				'description' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'expense_date' => 'sanitize_string',
				'payment_method' => 'sanitize_string',
				'receipt_url' => 'sanitize_string',
				'approved_by' => 'sanitize_string',
				'entered_by' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("expenses");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Expenses";
		$this->render_view("expenses/add.php");
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
		$fields = $this->fields = array("id","category_id","description","amount","expense_date","payment_method","receipt_url","approved_by","entered_by");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'category_id' => 'required|numeric',
				'description' => 'required',
				'amount' => 'required|numeric',
				'expense_date' => 'required',
				'payment_method' => 'required',
				'receipt_url' => 'required',
				'approved_by' => 'required|numeric',
				'entered_by' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'category_id' => 'sanitize_string',
				'description' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'expense_date' => 'sanitize_string',
				'payment_method' => 'sanitize_string',
				'receipt_url' => 'sanitize_string',
				'approved_by' => 'sanitize_string',
				'entered_by' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("expenses.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("expenses");
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
						return	$this->redirect("expenses");
					}
				}
			}
		}
		$db->where("expenses.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Expenses";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("expenses/edit.php", $data);
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
		$fields = $this->fields = array("id","category_id","description","amount","expense_date","payment_method","receipt_url","approved_by","entered_by");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'category_id' => 'required|numeric',
				'description' => 'required',
				'amount' => 'required|numeric',
				'expense_date' => 'required',
				'payment_method' => 'required',
				'receipt_url' => 'required',
				'approved_by' => 'required|numeric',
				'entered_by' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'category_id' => 'sanitize_string',
				'description' => 'sanitize_string',
				'amount' => 'sanitize_string',
				'expense_date' => 'sanitize_string',
				'payment_method' => 'sanitize_string',
				'receipt_url' => 'sanitize_string',
				'approved_by' => 'sanitize_string',
				'entered_by' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("expenses.id", $rec_id);;
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
		$db->where("expenses.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("expenses");
	}
}
