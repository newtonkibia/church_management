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
                    <h4 class="record-title">My Account</h4>
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
                        <div class="bg-primary m-2 mb-4">
                            <div class="profile">
                                <div class="avatar">
                                    <?php 
                                    if(!empty(USER_PHOTO)){
                                    Html::page_img(USER_PHOTO, 100, 100); 
                                    }
                                    ?>
                                </div>
                                <h1 class="title mt-4"><?php echo $data['membership_no']; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mx-3 mb-3">
                                    <ul class="nav nav-pills flex-column text-left">
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageView" class="nav-link active">
                                                <i class="fa fa-user"></i> Account Detail
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageEdit" class="nav-link">
                                                <i class="fa fa-edit"></i> Edit Account
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageChangeEmail" class="nav-link">
                                                <i class="fa fa-envelope"></i> Change Email
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageChangePassword" class="nav-link">
                                                <i class="fa fa-key"></i> Reset Password
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <div class="tab-content">
                                        <div class="tab-pane show active fade" id="AccountPageView" role="tabpanel">
                                            <table class="table table-hover table-borderless table-striped">
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
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="AccountPageEdit" role="tabpanel">
                                            <div class=" reset-grids">
                                                <?php  $this->render_page("account/edit"); ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane  fade" id="AccountPageChangeEmail" role="tabpanel">
                                            <div class=" reset-grids">
                                                <?php  $this->render_page("account/change_email"); ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="AccountPageChangePassword" role="tabpanel">
                                            <div class=" reset-grids">
                                                <?php  $this->render_page("passwordmanager"); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
