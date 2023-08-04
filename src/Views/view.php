<?php
use Yosicare\Task\Model\User;
$user = new User();
$id = base64_decode($_GET['id']);
$user->getId($id);
$userdata = $user->data;
include_once __DIR__.'/inc/header.php'; ?>
    <div class="container mt-5">

        <div class="starter-template">
            <div class="container pt-2">
                <div class='text-center mb-5'>
                    <h1>YosiCare Task Edit</h1>
                </div>
                <form id="form">
                    <div class="accordion-wrapper">
                        <div class="acc-head card p-3 rounded-0 active personal-information-head">
                            <h6> Personal Information </h6>
                        </div>
                        <div class="acc-body rounded-0 card show">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="first_name">First Name:</label>
                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                        <input type="text" class="form-control" id="first_name" value="<?= $userdata['first_name']; ?>" name="first_name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" class="form-control" id="last_name" value="<?= $userdata['last_name']; ?>" name="last_name" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="dob">Date of Birth:</label>
                                        <input type="date" class="form-control" id="dob" name="dob" value="<?= $userdata['dob']; ?>" required>
                                    </div>
                                    <div class="form-group col-md-6 radio-box d-flex pt-4 mt-3">
                                        <label>Gender:</label>
                                        <div class="form-check ml-2">
                                            <input type="radio" class="form-check-input" name="gender" id="male" value="MALE" <?php if($userdata[ 'gender']=="MALE" )
                                                {echo 'checked'; } ?> required>
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check ml-2">
                                            <input type="radio" class="form-check-input" name="gender" id="female" value="FEMALE" <?php if($userdata[ 'gender']=="FEMALE"
                                                ) {echo 'checked'; } ?> required>
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="female">Female</label>
                                            <span class="checkmark"></span>
                                        </div>
                                        <div class="form-check ml-2">
                                            <input type="radio" class="form-check-input" name="gender" id="other" value="OTHER" <?php if($userdata[ 'gender']=="OTHER"
                                                ) {echo 'checked'; } ?> required>
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="other">Other</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card p-3 my-3">
                                    <h6>Custom Fields </h6>

                                    <div id="customFieldsContainer">
                                        <?php if($userdata['customfields']) { 
                                            $customfields = json_decode($userdata['customfields']);
                                            // $customfields = is_string($customfields) ? json_decode($customfields) : $customfields;
                                            $i = 0;
                                            foreach($customfields as $key => $customfield){
                                                $i++;
                                                $field = array_values((array)$customfield);
                                                ?>
                                        <div class="form-row customfields-input-<?= $i ?>">
                                            <div class="form-group col-md-4">
                                                <label for="first_name">Key:</label>
                                                <input type="text" class="form-control" name="customfields[<?= $i ?>]['key']" value="<?= $field[0]?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="last_name">Value:</label>
                                                <input type="text" class="form-control" name="customfields[<?= $i ?>]['value']" value="<?= $field[1] ?>" required>
                                            </div>
                                            <div class="form-group col-md-2 pt-3">
                                                <button type="button" onclick="removeCustomField('.customfields-input-<?= $i ?>')" class="btn btn-danger btn-sm mt-3">
                                                    <i class="fas fa-close"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <?php    
                                            // }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <input type="hidden" id="customfields-count" value="<?= $i; ?>">
                                    <div class="form-group text-right">
                                        <button type="button" id="addCustomFieldButton" class="btn btn-success btn-sm">Add Custom Field</button>
                                    </div>
                                </div>
                                <div class="form-group text-right">

                                    <button class="btn btn-info " type="button" data-next=".contact-information-head" id="personal-information-submit">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-wrapper ">
                        <div class="acc-head contact-information-head card p-3 rounded-0">
                            <h6>Contact Information </h6>
                        </div>
                        <div class="acc-body rounded-0 card">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $userdata['email']?>" required>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-secondary back" type="button" data-next=".personal-information-head" id="contact-information-back">Back</button>
                                <button class="btn btn-info" type="button" data-next=".address-information-head" id="contact-edit--information-submit">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-wrapper">
                        <div class="acc-head card p-3 rounded-0 address-information-head">
                            <h6> Address Information </h6>
                        </div>
                        <div class="acc-body rounded-0 card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="address1">Address Line 1:</label>
                                    <input type="text" class="form-control" id="address1" name="address1" value="<?= $userdata['address1']?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="address2">Address Line 2:</label>
                                    <input type="text" class="form-control" id="address2" value="<?= $userdata['address2']?>" name="address2">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="zipcode">Zipcode:</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" value="<?= $userdata['zipcode']?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="city">City:</label>
                                        <input type="text" class="form-control" id="city" name="city" value="<?= $userdata['city']?>" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="state">State:</label>
                                        <input type="text" class="form-control" id="state" name="state" value="<?= $userdata['state']?>" required>
                                    </div>
                                </div>
                                <div id="errorMessage" class="hidden">
                                    <div class="tick">
                                        <i class="fas fa-warning"></i>
                                    </div>
                                    <p>Form submitted successfully!</p>
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-secondary back" type="button" data-next=".contact-information-head" id="address-information-back">Back</button>
                                    <button class="btn btn-info" type="button" id="edit-button">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="successMessage" class="hidden">
                    <div class="tick">
                        <i class="fas fa-check"></i>
                    </div>
                    <p>Form submitted successfully!</p>
                    <button onclick="window.location.reload()" class="btn btn-info btn-sm">Go to Form</button>
                </div>

            </div>

        </div>
    </div>
    <?php include_once __DIR__.'/inc/footer.php'; ?>