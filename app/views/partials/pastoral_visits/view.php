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
                    <h4 class="record-title">View  Pastoral Visits</h4>
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
                                    <tr  class="td-member_id">
                                        <th class="title"> Member Id: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['member_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="member_id" 
                                                data-title="Enter Member Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['member_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-requester_name">
                                        <th class="title"> Requester Name: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['requester_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="requester_name" 
                                                data-title="Enter Requester Name" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['requester_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-phone">
                                        <th class="title"> Phone: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['phone']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
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
                                        <td class="value">
                                            <span  data-value="<?php echo $data['email']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="email" 
                                                data-title="Enter Email" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="email" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['email']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-visit_reason">
                                        <th class="title"> Visit Reason: </th>
                                        <td class="value">
                                            <span  data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="visit_reason" 
                                                data-title="Enter Visit Reason" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['visit_reason']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-preferred_date">
                                        <th class="title"> Preferred Date: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['preferred_date']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="preferred_date" 
                                                data-title="Enter Preferred Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['preferred_date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-preferred_time">
                                        <th class="title"> Preferred Time: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['preferred_time']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="preferred_time" 
                                                data-title="Enter Preferred Time" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="time" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['preferred_time']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-location">
                                        <th class="title"> Location: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['location']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="location" 
                                                data-title="Enter Location" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['location']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-status">
                                        <th class="title"> Status: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['status']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="status" 
                                                data-title="Enter Status" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['status']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-assigned_pastor_id">
                                        <th class="title"> Assigned Pastor Id: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['assigned_pastor_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="assigned_pastor_id" 
                                                data-title="Enter Assigned Pastor Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['assigned_pastor_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-visit_notes">
                                        <th class="title"> Visit Notes: </th>
                                        <td class="value">
                                            <span  data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="visit_notes" 
                                                data-title="Enter Visit Notes" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['visit_notes']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-completed_at">
                                        <th class="title"> Completed At: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['completed_at']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("pastoral_visits/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="completed_at" 
                                                data-title="Enter Completed At" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['completed_at']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-created_at">
                                        <th class="title"> Created At: </th>
                                        <td class="value"> <?php echo $data['created_at']; ?></td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("pastoral_visits/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("pastoral_visits/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
