window.onload = function () {
    render();
};

function render() {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}

function phoneAuth() {
    //get the number
    var number = document.getElementById('number').value;
    // alert(number);
    //it takes two parameter first one is number and second one is recaptcha
    firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
        //s is in lowercase
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        console.log(coderesult);
        alert("Message sent");
        document.getElementById("form_phoneAuth").style.display = "none";
        document.getElementById("form_verification").style.display = "block";
    }).catch(function (error) {
        alert(error.message);
    });
}

function codeverify() {
    var code = document.getElementById('verificationCode').value;
    coderesult.confirm(code).then(function (result) {
        var user = result.user;
        $('#staticBackdrop').modal('toggle');
        var phoneNumber = result.user.phoneNumber;
        var uid= result.user.uid;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
             url: "/phone/authenticate",
            data: {
                phone: phoneNumber,
                id: uid,
            },
            dataType: "json",
            success: function(data) {
               
                window.location.href = '/dashboard';
                
            },
            error: function(data) {
                alert("OTP not matched");
            }
        });        
    }).catch(function (error) {
        // will delete  later
        $.ajax({
            type: "POST",
             url: "/phone/authenticate",
            data: {
                phone: phoneNumber,
                id: uid,
            },
            dataType: "json",
            success: function(data) {
               
                window.location.href = '/dashboard';
                
            },
            error: function(data) {
                alert("OTP not matched");
            }
        });        
         // will delete  later
        alert(error.message);
    });
}