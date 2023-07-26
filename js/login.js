const btnSub = document.getElementById("loginForm")
btnSub.addEventListener('submit', (function (e) {
    e.preventDefault();
    let userData = new FormData(document.forms.namedItem("loginData"))
    userData.append("login", "login")
    console.log(userData); 
    fetch('../sesion/sesionValidate.php', {
        method: 'POST',
        body: userData
    }).then((res) => res.json()).then((response) => {
        console.log(response);
        if (response === "success") {
            window.location.replace("../../views/index.php")
        }
        if (response === "error") {
            var valHtml = `<div class="text-center alert alert-danger" role="alert">Hay un error con tu usuario o contraseña intenta de nuevo</div>`;
            document.getElementById("alert").innerHTML = valHtml;
            setTimeout(() => {
                document.getElementById("alert").innerHTML = ``;
            }, 2500);
        }

    })
}))