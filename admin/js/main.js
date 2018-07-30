$(document).ready(function($) {

    $('#signinadmin').click(function() {
        $('#signinadmin').html('Signing In...');
        $('#signinadmin').css("disabled", "1");



        var phonenumber = $('#phonenumber').val();
        var password = $('#password').val();
        //alert(phonenumber);

        $.post("../exe/", {

            phonenumber: phonenumber,
            password: password

        }, function(adminSigninFeedback) {
            if (adminSigninFeedback == "1") {
                // $('#silsresp').html('<font color="green">Account created...</font>');
                window.location.href = "../index.php";
                $('#signinadmin').html('Sign In');
                $('#signinadmin').css("disabled", "0");
                console.log(agentSigninFeedback);
            } else {
                $('#lsresp').html('<font color="red">' + adminSigninFeedback + '</font>');
                $('#signinadmin').html('Sign In');
                $('#signinadmin').css("disabled", "0");
                console.log(adminSigninFeedback);
            }
        });
    });

});