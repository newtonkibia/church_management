<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Members</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-membership_no">
                                        <th class="title"> Membership No: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['membership_no']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="membership_no" 
                                                data-title="Enter Membership No" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['membership_no']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-first_name">
                                        <th class="title"> First Name: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['first_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="first_name" 
                                                data-title="Enter First Name" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['first_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-last_name">
                                        <th class="title"> Last Name: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['last_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="last_name" 
                                                data-title="Enter Last Name" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['last_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-phone">
                                        <th class="title"> Phone: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['phone']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="phone" 
                                                data-title="Enter Phone" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['phone']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-email">
                                        <th class="title"> Email: </th>
                                        <td class="value"> <?php echo $data['email']; ?></td>
                                    </tr>
                                    <tr  class="td-gender">
                                        <th class="title"> Gender: </th>
                                        <td class="value">
                                            <span  data-source='<?php echo json_encode_quote(Menu :: $gender); ?>' 
                                                data-value="<?php echo $data['gender']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="gender" 
                                                data-title="Enter Gender" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="radiolist" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['gender']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_of_birth">
                                        <th class="title"> Date Of Birth: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_of_birth']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="date_of_birth" 
                                                data-title="Enter Date Of Birth" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['date_of_birth']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-marital_status">
                                        <th class="title"> Marital Status: </th>
                                        <td class="value">
                                            <span  data-step="0.1" 
                                                data-value="<?php echo $data['marital_status']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="marital_status" 
                                                data-title="Enter Marital Status" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['marital_status']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-family_id">
                                        <th class="title"> Family Id: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['family_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="family_id" 
                                                data-title="Enter Family Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['family_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-residence_location">
                                        <th class="title"> Residence Location: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['residence_location']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="residence_location" 
                                                data-title="Enter Residence Location" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['residence_location']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-residence_city">
                                        <th class="title"> Residence City: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['residence_city']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="residence_city" 
                                                data-title="Enter Residence City" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['residence_city']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-residence_area">
                                        <th class="title"> Residence Area: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['residence_area']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="residence_area" 
                                                data-title="Enter Residence Area" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['residence_area']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-baptism_date">
                                        <th class="title"> Baptism Date: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['baptism_date']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="baptism_date" 
                                                data-title="Enter Baptism Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['baptism_date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-membership_date">
                                        <th class="title"> Membership Date: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['membership_date']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="membership_date" 
                                                data-title="Enter Membership Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['membership_date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-role">
                                        <th class="title"> Role: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['role']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="role" 
                                                data-title="Enter Role" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['role']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-created_at">
                                        <th class="title"> Created At: </th>
                                        <td class="value"> <?php echo $data['created_at']; ?></td>
                                    </tr>
                                    <tr  class="td-updated_at">
                                        <th class="title"> Updated At: </th>
                                        <td class="value"> <?php echo $data['updated_at']; ?></td>
                                    </tr>
                                    <tr  class="td-username">
                                        <th class="title"> Username: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['username']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("members/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="username" 
                                                data-title="Enter Username" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['username']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("members/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("members/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
