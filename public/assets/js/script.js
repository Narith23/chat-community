function register() { 
    let usename = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("userpassword").value;

    $.ajax({
        type: "POST",
        url: "http://127.0.0.1:8000/user/register",
        data: {
            username: usename,
            email: email,
            password: password
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
        }
    });
}
