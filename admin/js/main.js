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

        }, function(adminSigninFeedback) 
        {
            if (adminSigninFeedback == 1) 
            {
                //$('#lsresp').html('<font color="green">Account created...</font>');
                //window.location.href = "../admin.php";
                //location.reload();
                window.location = "../admin/admin.php";
            } else {
                $('#lsresp').html('<font color="red">' + adminSigninFeedback + '</font>');
                $('#signinadmin').html('Sign In');
                $('#signinadmin').css("disabled", "0");
                console.log(adminSigninFeedback);
            }
        });
    });


    // admin delete driver

    $("#deletewrapper #deletedrivertbtn").click(function(event) {
        $(this).html("Please wait...");
        $(this).attr('disabled', 'disabled');

        var driverid = $(this).val();

        $.post('system/deletedriver/', 
        {
            driverid:driverid
        }, 
        function(data, textStatus, xhr) {
            if (data == 1) {
                swal({
                  title: "Success!",
                  text: "Driver was deleted successfully.",
                  icon: "success",
                  // buttons: true,
                  // dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    window.location.href = "admin.php";
                  }
                });
            }
            else{
                $("#deleteresponse"+driverid).html("<font class='text-warning'>"+data+"</font>");
                $("#deletewrapper #deletedrivertbtn").attr('disabled', false);
                $("#deletewrapper #deletedrivertbtn").html('Yes, Delete <i class="ion-ios-arrow-thin-right">&nbsp;</i>');
            }
        });
    });


    // admin edit driver

    $("#editdriverpwrap #editbtn").click(function(event) {
        $(this).html("Please wait...");
        $(this).attr('disabled', 'disabled');

        var driverid   = $(this).val();
        var name       = $("#e_name_"+driverid).val();
        var phone      = $("#e_phone_"+driverid).val();
        var regno      = $("#e_regno_"+driverid).val();
        var enginesize = $("#e_engineSize_"+driverid).val();
        var location   = $("#e_location_"+driverid).val();
        var status     = $("#e_status_"+driverid).val();
        
        $.post('system/editdriver/', 
        {
            driverid:driverid,
            name:name,
            phone:phone,
            regno:regno,
            enginesize:enginesize,
            location:location,
            status:status
        }, 
        
        function(data, textStatus, xhr) {
            if (data == 1) {
                swal({
                  title: "Success!",
                  text: "Driver was edited successfully.",
                  icon: "success",
                })
                .then((willEdit) => {
                  if (willEdit) {
                    window.location.href = "admin.php";
                  }
                });
            }
            else{
                $("#editresponse"+driverid).slideDown().html("<font class='text-warning'>"+data+"</font>").delay(5000).slideUp();
                $("#editdriverpwrap #editbtn").attr('disabled', false);
                $("#editdriverpwrap #editbtn").html('Update <i class="ion-ios-arrow-thin-right">&nbsp;</i>');
            }
        });
    });


    // change admin password

    $("#accountlock").click(function() {
        $(this).html("Please wait...");
        $(this).attr('disabled', 'disabled');

        var oldpass     = $("#editoldpassword").val();
        var newpass     = $("#editnewpassword").val();
        var confirmpass = $("#editcnewpassword").val();

        $.post('system/changepass/',
        {
            oldpass:oldpass,
            newpass:newpass,
            confirmpass:confirmpass
        }, 
        function(data, textStatus, xhr) {
            $("#accountlock").html('Change Password <i class="ion-ios-arrow-thin-right">&nbsp;</i>');
            $("#accountlock").attr('disabled', false);
            $("#passresponse").slideDown().html(data).delay(5000).slideUp();
        });
    });

});