
jQuery(document).ready(function () {
    jQuery.validator.addMethod("imageExtension", function(value, element) {
        if (element.files.length === 0) {
            return true;
        }
        return /\.(jpe?g|png|webp)$/i.test(value);
    }, "Only JPG, JPEG, PNG, or WEBP files are allowed."); 

    jQuery('#custom-form').validate({
        rules: {
            image: {
                required: true, 
                imageExtension: true 
            },
            name: {
                required: true,
            },
            rashi: {
                required: true,
            },
            dob: {
                required: true,
            },
            contact_number: {
                required: true,
            },
            time_of_birth: {
                required: true,
            },
            address: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
            },
            image: {
                required: "Please upload an image.",
                imageExtension: "Only JPG, JPEG, PNG, or WEBP files are allowed."
            },
            gender: {
                required: "Please select rashi",
            },
            dob: {
                required: "Please select Date of birth",
            },
            contact_number: {
                required: "Please add contact number",
            },
            address: {
                required: "Please enter a Address",
            },
            time_of_birth: {
                required: "Please enter a time",
            },
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            formData.append('action', 'submit_custom_form');

            jQuery.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert(result.message);
                        jQuery('#custom-form')[0].reset();
                    } else {
                        alert('Error: ' + result.message);
                    }
                },
                error: function () {
                    alert('An error occurred while submitting the form.');
                }
            });
        }
    });






    





    
});




