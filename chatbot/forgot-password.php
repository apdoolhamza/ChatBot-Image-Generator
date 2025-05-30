<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <script src="./assets/sidebar/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>ChatBot AI | Forgot Paasword</title>
    <link rel="shortcut icon" href="./assets/img/logo.png" type="image/x-icon">
    <!-- font awesome icons file -->
    <link rel="stylesheet" href="./assets/fontawesome/all.css">
    <!-- css files -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/sign-in.css" rel="stylesheet">
    <link href="./assets/css/popUp.css" rel="stylesheet">
    <style>
    @font-face {
	    font-family: '33535gillsansmt';
	   src: local('33535gillsansmt'), url('./assets/webfonts/33535gillsansmt.woff') format('woff');
    }
	  *{
		outline:none !important;
		border:none;
	  }
	  body{
		font-family: '33535gillsansmt' !important;
	  }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
      [data-bs-theme="dark"] .dynamic-theme-text {
        color: var(--bs-light);
      }
      [data-bs-theme="light"] .dynamic-theme-text {
        color: var(--bs-dark);
      }
      .form-control:focus{
        border:1px solid #6e74e5;
        box-shadow:0 0 5px #6e74e5;
      }
    </style>
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

<main class="form-signin w-100 m-auto">
  <form method="post" novalidate>
    <img class="mb-4" src="./assets/img/logo.png" alt="" width="102" height="93">
    <h1 class="h3 mb-3 fw-normal">Forgot password</h1>

    <div class="form-floating">
      <input type="text" class="form-control" name="username" id="username" placeholder="apdoolhamza" required>
      <label for="username">Username</label>
    </div>
    <div class="form-floating">
      <input type="email" style="border-top-left-radius:0;border-top-right-radius: 0;" class="form-control" name="email" id="email" placeholder="***@gmail.com" required>
      <label for="email">E-mail</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Password" required>
      <label for="newpassword">New Password</label>
    </div>
    <button class="btn btn-primary w-100 py-2 rounded-1 my-3" type="submit" name="submit">Change</button>
    <div class="pt-2" style="text-align:center;">
    <a href="user-sign.php" class="nav-link">Remenber password? <span style="color: #6e74e5;text-decoration:underline">Sign In</span></a>
    </div>
    <p class="mt-4 mb-3 text-body-secondary">&copy; ChatBot AI v2.0</p>
  </form>
</main>
<!-- js files -->
<script src="./assets/js/popUp.js"></script>
<script src="./assets/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/jquery.min.js"></script>

<script>
function checkValidation() {
jQuery.ajax({
url: "ajex_validators/check-forgot-validation.php",
data:'username=' + $("#username").val() + '& email=' + $("#email").val() + '& newpassword=' + $("#newpassword").val(),
method: "POST",
success: function(response){
    if (username.value !== "" && email.value !== "" && newpassword.value !== "") {
    let match = /user-sign.php/igm;
    if (match.test(response)) {
        window.location.href = response;
    } else {
        popUp('',response);
    }
}
},
error: function (){}
});
}


const form = document.querySelector('form');
const formInputs = document.querySelectorAll('form input');
const emailInput = document.querySelector('input[type="email"]');
const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
// check if forms input are empty
form.addEventListener('submit', () => {
for (let inputs of formInputs) {
    if (inputs.value === "") {
        popUp('Error','Inputs should not be empty!');
        event.preventDefault();
    }
}
if(!emailInput.value.match(emailRegex) && emailInput.value != ""){
    popUp('Error','Invalid E-mail format!');
    event.preventDefault();
} else {
  event.preventDefault();
  checkValidation();
}
})

for (let inputs of formInputs) {
    inputs.addEventListener('focus', () => {
    closePopUp();
    })
}
</script>
</body>
</html>
