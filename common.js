window.addEventListener("load", function () {
    var login_form = document.getElementById("login-form");
    if (login_form) {
        login_form.addEventListener("submit", function (event) {
            event.preventDefault();

            var xhr = new XMLHttpRequest();
            var form_data = new FormData(login_form);

            xhr.addEventListener("load", function (e) {
                var response = JSON.parse(e.target.responseText);
                alert(response.message); 
            });

            xhr.addEventListener("error", function () {
                alert('Oops! Something went wrong.');
            });

            xhr.open("POST", "api/login_submit.php");
            xhr.send(form_data);
        });
    }
});