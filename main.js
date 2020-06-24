var successMessage = `
    <div>
        <p>Votre demande de contact a bien été prise en compte. <br> <br> Nous reviendrons vers vous dans les plus bref delais.</p>
        <button class="btn">
            <a href="/">Acceuil</a>
        </button>
    </div>
                    `

var notif = ` <div class="alert show showAlert">
<span class="fas fa-exclamation-circle"></span>
<span class="msg">Attention: Une erreur c'est produite</span>
<div class="close-btn">
    <span class="fas fa-times"></span>
</div>
</div>`

function sendEmail() {
    var firstname = $("#firstname");
    var lastname = $("#lastname");
    var email = $("#email");
    var phone = $("#phone");

    if (isNotEmpty(firstname) && isNotEmpty(lastname) && isNotEmpty(email) && isNotEmpty(lastname) && isNotEmpty(phone)) {
        if (phonenumber(phone)) {

            $.ajax({
                url: 'sendEmail.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    firstname: firstname.val(),
                    lastname: lastname.val(),
                    email: email.val(),
                    phone: phone.val(),
                }, success: function (response) {
                    if (response.status == "success") {
                        let f = $(".form");
                        let p = $("#contact-p");
                        p.remove();
                        f.remove();
                        let el = $("._contact-form");
                        el.append(successMessage)
                    }
                    else {
                        alert('Please Try Again!');
                        let el = $("._contact-form");
                        el.append(successMessage)
                        setTimeout(function () {
                            $('.alert').removeClass("show");
                            $('.alert').addClass("hide");
                        }, 5000);
                        console.log(response);
                    }
                }
            });
        }
    }
}

function isNotEmpty(caller) {
    if (caller.val() == "") {
        caller.css('border', '1px solid red');
        return false;
    } else
        caller.css('border', '');
    return true;
}

function phonenumber(number) {
    var phoneno = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;
    if ((number.val().match(phoneno))) {
        return true;
    }
    else {
        number.css('border', '1px solid red');
        return false;
    }
}