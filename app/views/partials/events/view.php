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
                    <h4 class="record-title">View  Events</h4>
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
                                    <tr  class="td-event_title">
                                        <th class="title"> Event Title: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['event_title']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("events/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="event_title" 
                                                data-title="Enter Event Title" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['event_title']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-event_description">
                                        <th class="title"> Event Description: </th>
                                        <td class="value">
                                            <span  data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("events/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="event_description" 
                                                data-title="Enter Event Description" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['event_description']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-event_date">
                                        <th class="title"> Event Date: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['event_date']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("events/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="event_date" 
                                                data-title="Enter Event Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['event_date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-start_time">
                                        <th class="title"> Start Time: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['start_time']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("events/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="start_time" 
                                                data-title="Enter Start Time" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="time" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['start_time']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-end_time">
                                        <th class="title"> End Time: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['end_time']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("events/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="end_time" 
                                                data-title="Enter End Time" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="time" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['end_time']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-location">
                                        <th class="title"> Location: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['location']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("events/editfield/" . urlencode($data['id'])); ?>" 
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
                                    <tr  class="td-is_recurring">
                                        <th class="title"> Is Recurring: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['is_recurring']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("events/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="is_recurring" 
                                                data-title="Enter Is Recurring" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['is_recurring']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-recurring_pattern">
                                        <th class="title"> Recurring Pattern: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['recurring_pattern']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("events/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="recurring_pattern" 
                                                data-title="Enter Recurring Pattern" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['recurring_pattern']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-contact_person">
                                        <th class="title"> Contact Person: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['contact_person']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("events/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="contact_person" 
                                                data-title="Enter Contact Person" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['contact_person']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-contact_phone">
                                        <th class="title"> Contact Phone: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['contact_phone']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("events/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="contact_phone" 
                                                data-title="Enter Contact Phone" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['contact_phone']; ?> 
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("events/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("events/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
