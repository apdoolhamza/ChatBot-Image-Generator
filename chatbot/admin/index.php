
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <script src="../assets/sidebar/color-modes.js"></script>
 <title>ChatBot AI | Admin Sign In</title>
 <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">
<!-- font awesome icons file -->
<link rel="stylesheet" href="../assets/fontawesome/all.css">
<!-- css files -->
<link href="../assets/css/popUp.css" rel="stylesheet">
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/sign-in.css" rel="stylesheet">
<style>
    @font-face {
	    font-family: '33535gillsansmt';
	   src: local('33535gillsansmt'), url('../assets/webfonts/33535gillsansmt.woff') format('woff');
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
      #errprAlert{
      display:none;
      }
      label{
    font-weight: 100 !important;
      }
    </style>
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">  
<main class="form-signin w-100 m-auto">
  <form id="login-frm" method="post" novalidate>
    <img class="mb-4" src="../assets/img/logo.png" alt="" width="102" height="93">
    <h1 class="h3 mb-3 fw-normal">Admin sign in</h1>
    <div class="form-floating">
      <input type="email" class="form-control" name="useremail" id="useremail" maxlength="40" spellcheck="false" placeholder="E-Mail  eg.&nbsp;***@gmail.com" required>
      <label for="useremail">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" maxlength="10" placeholder="Password eg.&nbsp;******" required>
      <label for="password">Password</label>
    </div>
    <button class="btn mt-3 btn-primary w-100 py-2 rounded-1" type="submit" name="login">Sign In</button>
    <div class="my-3 mt-4" style="text-align:center;">
    <a href="../index.php" class="btn">Back To <span style="color:#6e74e5;">Home Page</span></a>
    </div>
    <p class="mt-4 mb-3 text-body-secondary">&copy; ChatBot AI v2.0</p>
  </form>
</main>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/popUp.js"></script>
<script src="./assets/js/verify.js"></script>
<script>
function checkValidation() {
  event.preventDefault();
jQuery.ajax({
url: "ajex_validators/check-login-validation.php",
data:'useremail=' + $("#useremail").val() + '& password=' + $("#password").val(),
method: "POST",
success: function(response){
if (useremail.value !== "" && password.value !== "") {
    let match = /User not found!/igm;
    if (match.test(response)) {
        popUp('',response);
    } else {
    window.location.href = response;
    }
}
},
error: function (){}
});
}


const Inputs = document.querySelectorAll('form input');
document.querySelector('form').addEventListener('submit', () => {
    for (let input of Inputs) {
    if (input.value == "") {
        popUp('','Inputs should not be empty!');
        event.preventDefault();
} else {
    checkValidation();
}
}
})
</script>
</body>
</html>