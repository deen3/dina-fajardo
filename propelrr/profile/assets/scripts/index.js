$(document).ready(function () {
    $("form").submit(function (event) {
        event.preventDefault();
        
        if (!validate_form_fields()) {
            return;
        }

        var formData = {
            full_name: $("#full-name").val(),
            email_address: $("#email-address").val(),
            mobile_number: $("#mobile-number").val(),
            bday: $("#bday").val(),
            age: $("#age").val(),
            gender: $("#gender").val(),
        };
    
        $.ajax({
            type: "POST",
            url: "add-profile.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (data['success']) {
                clear_fields();
                $("#alert").html("Successfully added!");
                $("#alert").addClass("alert alert-success");
            } else {
                errors = data['errors'];
                for(key in errors) {
                    $(`#${key}-validation`).html(`${errors[key]}`)
                }
            }
        }).fail(function(xhr, status, error) {
            alert(`${status}: ${error}`);
        });

    
    });

    $("#bday").on('keydown', function() {
        return false;
    });

    $("#bday").on('change', function() {
        const cur_date = new Date();
        let bday = new Date(this.value);
        let age = parseInt(cur_date.getFullYear()) - parseInt(bday.getFullYear()); 
        
        $("#age").val(age);
    });
});

function clear_fields() {
    $("#full-name").val('');
    $("#email-address").val('');
    $("#mobile-number").val('');
    $("#bday").val('');
    $("#age").val('');
    $("#gender").val('');
}

function validate_form_fields() {
    let valid = true;
    let errors = {};
    const required_fields = ['full-name', 'email-address', 'mobile-number', 'bday', 'gender'];
    const name_regex = /^[A-Za-z., ]*$/;
    const email_regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const mobile_regex = /^09[0-9]{9}$/;

    $('.validation').html('');

    if (!$("#full-name").val().match(name_regex)) {
        valid = false;
        errors['full-name'] = 'Full name can only be letters, period and comma.';
    } 
    if (!$("#email-address").val().match(email_regex)) {
        valid = false;
        errors['email-address'] = 'Invalid email format.';
    } 
    if (!$("#mobile-number").val().match(mobile_regex)) {
        valid = false;
        errors['mobile-number'] = 'Invalid mobile number format.';
    } 

    required_fields.forEach((field) => {
        if ($(`#${field}`).val() == "") {
            valid = false;
            errors[field] = `${field.replace('-', ' ')} is required.`;
        }
    });

    if (!valid) {
        for(key in errors) {
            $(`#${key}-validation`).html(`${errors[key]}`)
        }
    }

    return valid;
}