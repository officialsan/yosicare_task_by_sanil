$(document).ready(function() {
    const APP_URL = $('#app-url').val();
    $(window).keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });

    $("#personal-information-submit").click(function() {
        $("input").removeClass("is-invalid");
        $(".error-msg").remove();

        let isValid = true;

        const firstName = $("#first_name");
        if (firstName.val().trim() === "") {
            firstName.addClass("is-invalid");
            firstName.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        }

        const lastName = $("#last_name");
        if (lastName.val().trim() === "") {
            lastName.addClass("is-invalid");
            lastName.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        }
        const dob = $("#dob");
        if (dob.val().trim() === "") {
            dob.addClass("is-invalid");
            dob.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        }
        var curDate = new Date();
        var dobDate = new Date(dob.val().trim());
        if (dobDate > curDate) {
            dob.addClass("is-invalid");
            dob.after('<p class="error-msg">Invalid date</p>');
            isValid = false;
        }

        const gender = $("input[name='gender']:checked");
        if (!gender.val()) {
            $("input[name='gender']").addClass("is-invalid");
            gender.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        }
        if (!isValid) return true;
        let next = $(this).data('next');
        openSection($(next));
    });

    $("#contact-information-submit").click(function() {
        $("input").removeClass("is-invalid");
        $(".error-msg").remove();

        let isValid = true;
        const email = $("#email");
        let next = $(this).data('next');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.val().trim() === "") {
            email.addClass("is-invalid");
            email.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        } else if (!emailRegex.test(email.val().trim())) {
            email.addClass("is-invalid");
            email.after('<p class="error-msg">Invalid email id</p>');
            isValid = false;
        }
        if (!isValid) return true;
        $.post(APP_URL + "api/check-email", {
                'email': email.val().trim()
            })
            .done(function(data) {
                console.log(data)
                let responseData;
                try {
                    responseData = JSON.parse(data); // Try to parse JSON
                } catch (error) {
                    responseData = data; // If not JSON, keep the original response as is
                }
                if (responseData.status == "Error") {
                    email.addClass("is-invalid");
                    email.after('<p class="error-msg">' + responseData.message + '</p>');
                    return false;
                }

                openSection($(next));
            });
    });
    $("#contact-edit--information-submit").click(function() {
        $("input").removeClass("is-invalid");
        $(".error-msg").remove();

        let isValid = true;
        const email = $("#email");
        let next = $(this).data('next');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.val().trim() === "") {
            email.addClass("is-invalid");
            email.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        } else if (!emailRegex.test(email.val().trim())) {
            email.addClass("is-invalid");
            email.after('<p class="error-msg">Invalid email id</p>');
            isValid = false;
        }
        if (!isValid) return true;
        openSection($(next));
    });

    $("#submit-button").click(function() {
        $("input").removeClass("is-invalid");
        $(".error-msg").remove();

        let isValid = addressFromValidation();
        if (!isValid) return true;
        var form_data = $("#form").serialize();

        $.post(APP_URL + "api/insert", form_data)
            .done(function(data) {
                console.log(data)
                let responseData;
                try {
                    responseData = JSON.parse(data); // Try to parse JSON
                } catch (error) {
                    responseData = data; // If not JSON, keep the original response as is
                }
                if (responseData.status == "Success") {
                    $("#form").hide();
                    $("#successMessage p").html(responseData.message)
                    $("#successMessage").removeClass("hidden");
                }
                $("#errorMessage").removeClass("hidden");
            });
    });
    $("#edit-button").click(function() {
        $("input").removeClass("is-invalid");
        $(".error-msg").remove();
        
        let isValid = addressFromValidation();
        if (!isValid) return true;
        var form_data = $("#form").serialize();

        $.post(APP_URL + "api/update", form_data)
            .done(function(data) {
                console.log(data)
                let responseData;
                try {
                    responseData = JSON.parse(data); // Try to parse JSON
                } catch (error) {
                    responseData = data; // If not JSON, keep the original response as is
                }
                if (responseData.status == "Success") {
                    $("#form").hide();
                    $("#successMessage p").html(responseData.message);
                    $("#successMessage").removeClass("hidden");
                }
                $("#errorMessage p").html(responseData.message);
                $("#errorMessage").removeClass("hidden");
            });
    });

    $(".back").click(function() {
        let next = $(this).data('next');
        openSection($(next));
    });

    $('input').keyup(function() {
        let val = $(this).val();
        if (val != "") {
            $(this).removeClass("is-invalid");
            $(this).next('.error-msg').remove();
        }
    });

    $('#zipcode').keyup(function() {
        let zipcode = $("#zipcode");
        let zipcodeRegex = /^\d{5}(?:-\d{4})?$/;
        if (zipcode.val().trim() === "" || !zipcodeRegex.test(zipcode.val().trim())) {
            return true;
        }
        let url = APP_URL + "api/zipcode?zipcode=" + zipcode.val().trim();
        $.ajax({
            url: url,
            crossorigin: false,
            dataType: "json",
            success: function(data) {
                data = JSON.parse(data);
                $('#city').val(data.city);
                $('#state').val(data.state);
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });
    let customFieldCount = $("#customfields-count").val() ?? 0;
    $("#addCustomFieldButton").click(function () {
        const customFieldInput = `
            <div class="form-row customfields-input-${customFieldCount}">
                <div class="form-group col-md-4">
                    <label for="first_name">Key:</label>
                    <input type="text" class="form-control"   name="customfields[${customFieldCount}][key]" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Value:</label>
                    <input type="text" class="form-control"   name="customfields[${customFieldCount}][value]" required>
                </div>
                <div class="form-group col-md-2 pt-3">
                <button type="button" onclick="removeCustomField('.customfields-input-${customFieldCount}')" class="btn btn-danger btn-sm mt-3"><i class="fas fa-close"></i></button>
                </div>
            </div>
        `;
        customFieldCount++;
        // Append the custom field input to the container
        $("#customFieldsContainer").append(customFieldInput);
      });
    
});

function openSection(e) {
    $('.acc-body').slideUp(500);
    $('.acc-body').removeClass('active');
    $(e).next().slideDown(500);
    $(e).toggleClass('active');
}
function removeCustomField(e){
    $(e).remove();
}
function addressFromValidation() {
        let isValid = true;

        const address1 = $("#address1");
        if (address1.val().trim() === "") {
            address1.addClass("is-invalid");
            address1.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        }

        const address2 = $("#address2");
        if (address2.val().trim() === "") {
            address2.addClass("is-invalid");
            address2.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        }

        const city = $("#city");
        if (city.val().trim() === "") {
            city.addClass("is-invalid");
            city.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        }

        const state = $("#state");
        if (state.val().trim() === "") {
            state.addClass("is-invalid");
            state.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        }

        const zipcode = $("#zipcode");
        const zipcodeRegex = /^\d{5}(?:-\d{4})?$/;
        if (zipcode.val().trim() === "") {
            zipcode.addClass("is-invalid");
            zipcode.after('<p class="error-msg">Please enter this field</p>');
            isValid = false;
        } else if (!zipcodeRegex.test(zipcode.val().trim())) {
            zipcode.addClass("is-invalid");
            zipcode.after('<p class="error-msg">Invalid zipcode</p>');
            isValid = false;
        }
        return isValid;
}

 