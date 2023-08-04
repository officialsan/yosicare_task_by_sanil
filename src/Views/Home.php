<?php
include_once __DIR__.'/inc/header.php'; ?>
    <div class="container mt-5">

        <div class="starter-template">
            <div class="container pt-2">
                <div class='text-center mb-5'>
                    <h1>YosiCare Task</h1>
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
                                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="dob">Date of Birth:</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required>
                                    </div>
                                    <div class="form-group col-md-6 radio-box d-flex pt-4 mt-3">
                                        <label>Gender:</label>
                                        <div class="form-check ml-2">
                                            <input type="radio" class="form-check-input" name="gender" id="male" value="MALE" required>
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check ml-2">
                                            <input type="radio" class="form-check-input" name="gender" id="female" value="FEMALE" required>
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="female">Female</label>
                                            <span class="checkmark"></span>
                                        </div>
                                        <div class="form-check ml-2">
                                            <input type="radio" class="form-check-input" name="gender" id="other" value="OTHER" required>
                                            <span class="checkmark"></span>
                                            <label class="form-check-label" for="other">Other</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card p-3 my-3">
                                    <h6>Custom Fields </h6>

                                    <div id="customFieldsContainer">

                                    </div>
                                    <input type="hidden" id="customfields-count" value="0">
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
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-secondary back" type="button" data-next=".personal-information-head" id="contact-information-back">Back</button>
                                <button class="btn btn-info" type="button" data-next=".address-information-head" id="contact-information-submit">Next</button>
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
                                    <input type="text" class="form-control" id="address1" name="address1" required>
                                </div>
                                <div class="form-group">
                                    <label for="address2">Address Line 2:</label>
                                    <input type="text" class="form-control" id="address2" name="address2">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="zipcode">Zipcode:</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="city">City:</label>
                                        <input type="text" class="form-control" id="city" name="city" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="state">State:</label>
                                        <input type="text" class="form-control" id="state" name="state" required>
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
                                    <button class="btn btn-info" type="button" id="submit-button">Submit</button>
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