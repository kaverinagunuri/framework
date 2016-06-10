$(document).ready(function () {

    $("#Form").validate({
        rules: {
            FirstName: {
                required: true,
                minlength: 3
            },
            LastName: {
                required: true,
                minlength: 3
            },
            UserName: {
                required: true,
                email: true
            },
            Password: {
                required: true,
                minlength: 8
            },
            Confirm: {
                required: true,
                minlength: 8,
                equalTo: "#Password"
            },
            gender: {
                required: true,
            },
        },
        messages: {
            FirstName: {
                required: "Please Enter your FirstName ",
                minlength: "Your FirstName Consists Atleast 3 characters"

            },
            LastName: {
                required: "Please Enter your LastName ",
                minlength: "Your LastName Consists Atleast 3 characters"

            },
            Password: {
                required: "Please Enter your Password ",
                minlength: "Your Password Consists Atleast 8 characters"

            },
            Confirm: {
                required: "Please Enter  Confirm Password ",
                minlength: "Your Confirm Password Consists Atleast 8 characters",
                equalTo: "Enter the Same Password as above"

            },
            gender: {
                required: "Select the Gender Name"
            },
            UserName: {
                required: "Please Provide the EmailId",
                email: "Email Id Should be a Valid ",
            }


        }
    });
});


