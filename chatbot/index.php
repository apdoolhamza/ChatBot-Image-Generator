<?php 
session_start(); 
require_once('./admin/include/config.php');

// check if the browser has an active internet connection
function isConnected() {
  $connected = @fsockopen("www.google.com", 80); // Try to connect to Google on port 80
  if ($connected) {
      fclose($connected);
      return true; // Internet connection is available
  } else {
      return false; // No internet connection
  }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
   <script src="./assets/sidebar/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>ChatBot - AI</title>
    <link rel="shortcut icon" href="./assets/img/logo.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/fontawesome/all.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./assets/css/adminlte.css">
    <link rel="stylesheet" href="./assets/css/custom.css">
 <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
<style>
  @font-face {
	font-family: '33535gillsansmt';
	src: local('33535gillsansmt'), url('./assets/webfonts/33535gillsansmt.woff') format('woff');
    }
	*{
		outline:none !important;
		box-shadow:none !important;
		border:none;
	}
	body{
		font-family: '33535gillsansmt' !important;
    font-display: swap !important;
	}
	textarea{
		resize:none;
	}
	.form-control:focus{
		outline:none;
		box-shadow:none;
		border:1px solid #6e74e5;
	}
	#chat_convo{
		max-height: calc(100vh - 6rem);
		width:50vw;
	}
	#chat_convo .direct-chat-messages{
		height:100%;
	}
	.direct-chat-text {
		margin-left:12px;
		padding:13px 17px;
		max-width:60%;
		display:inline-block;
    }
	.right .direct-chat-text {
		float:right;
     }
	#chat_convo .card-body {
	   overflow-y:scroll !important;
       overflow-x:hidden !important;
       user-select:none !important;
	}
	#navBarsContainer{
		width:calc(100% - 40px);
		visibility: hidden;
	}
	@media (max-width:990px) {
		#chat_convo{
			width:90vw;
		}
		#navBarsContainer{
		visibility: visible;
	}
	}
	@media (max-width:500px) {
		.direct-chat-text {
		margin-right: 0;
		max-width:calc(100% - 5rem);
    }
	}
	#navBtn span{
		height:2px;
		display:grid;
		border-radius:5px;
	}
	#navBtn span:nth-child(1){
		width:20px;
		margin-bottom:7px;
	}
	#navBtn span:nth-child(2){
		width:13px;
	}

  [data-bs-theme="dark"] .dynamic-theme-text {
    color: var(--bs-light);
  }
  [data-bs-theme="light"] .dynamic-theme-text {
    color: var(--bs-dark);
  }
	[data-bs-theme="dark"] .dynamic-theme-bg {
    background-color: var(--bs-light);
  }
  [data-bs-theme="light"] .dynamic-theme-bg {
    background-color: var(--bs-dark);
  }
  .fa-spinner{
	animation: spin 2s infinite linear;
  }
  @keyframes spin {0%{rotate:0deg;}100%{rotate:360deg;}}

  .autoscroll{
    scroll-behavior:auto !important;
    cursor:default;
    overflow-x: hidden;
    scrollbar-width:thin;
    scrollbar-color: #00000060 transparent;
  }
  .isScroll{
    cursor:move !important;
  }
.nav-link:hover,
.nav-link:active,
.nav-link:focus{
		color: silver;
}
.currModel{
	z-index:99;
	width:46px;
	height:35px;
	margin-right:4.6rem;
	margin-top:6.5px;
	display:flex;
	justify-content:center;
	align-items:center;
	border-radius:5px !important;
}
.btn:hover{
	background-color: #6e74e5dd;
}
#userInput{
	padding-right:4rem;
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

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

      /* request loading indicator styles */
      .loaderDiv{
        padding:5px 10px;
        position: absolute;
        margin-top:-4.5rem;
        margin-left:4rem;
        display:none;
      }
      .loader {
      width:30px;
      aspect-ratio: 2;
      --_g: no-repeat radial-gradient(circle closest-side,var(--light) 90%,#0000);
      background:
      var(--_g) 0% 50%,
      var(--_g) 50% 50%,
      var(--_g) 100% 50%;
      background-size: calc(100%/3) 50%;
      animation: l3 1s infinite linear;
      }
      @keyframes l3 {
      20%{background-position:0% 0%, 50% 50%,100% 50%}
      40%{background-position:0% 100%, 50% 0%,100% 50%}
      60%{background-position:0% 50%, 50% 100%,100% 0%}
      80%{background-position:0% 50%, 50% 50%,100% 100%}
      }

      /* terminate request btn */
      #stopButton{
        display:flex;
        justify-content:center;
        align-items:center;
        display:none;
      }

      /* generated imgs */
      #generatedImg{
        width:100%;
        border-radius:10px;
      }
    </style>
      <link href="./assets/sidebar/sidebars.css" rel="stylesheet">
      <link rel="stylesheet" href="./assets/css/asycRequest.css">

     <!-- jQuery -->
    <script src="./assets/js/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
     
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/sidebar/sidebars.js"></script>
    <script src="./assets/js/asycRequest.js"></script>
  </head>
<body style="display:flex;">

<!-- Spinner loader -->
<div class="asycRequest">
<div class="bounce1"></div>
<div class="bounce2"></div>
<div class="bounce3"></div>
</div>

<!-- Svg icons -->
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
     <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278M4.858 1.311A7.27 7.27 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.32 7.32 0 0 0 5.205-2.162q-.506.063-1.029.063c-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286"/>
     <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
     <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
    </symbol>
  </svg>
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="history" viewBox="0 0 16 16">
  <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
  <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
  <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
    </symbol>
    <symbol id="home" viewBox="0 0 16 16">
      <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
    </symbol>
    <symbol id="chat" viewBox="0 0 16 16">
    <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
    </symbol>
    <symbol id="chat-dots" viewBox="0 0 16 16">
    <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
    <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2"/>
    </symbol>
    <symbol id="pencil-dash" viewBox="0 0 21 21">
    <path d="M21.8,4.5c-0.3-0.7-0.9-1.3-1.6-1.6c-1.5-0.6-3.2,0.1-3.9,1.5l-4.6,10.3c-0.4,0.9-0.5,2-0.4,2.9l0.4,2.2    c0.1,0.3,0.3,0.6,0.6,0.7c0.1,0.1,0.3,0.1,0.4,0.1c0.2,0,0.4-0.1,0.5-0.2l1.9-1.2c0.9-0.6,1.5-1.3,1.9-2.3l4.6-10.3    C22.1,6,22.1,5.2,21.8,4.5z M15.4,16.3c-0.3,0.6-0.7,1-1.2,1.4l-0.7,0.4l-0.1-0.7c-0.1-0.6,0-1.2,0.2-1.8l3.5-8l1.8,0.7L15.4,16.3    z M20,5.9l-0.2,0.5L18,5.7l0.2-0.5c0.2-0.4,0.5-0.6,0.9-0.6c0.1,0,0.3,0,0.4,0.1C19.7,4.8,19.9,5,20,5.2c0,0,0,0,0,0    C20.1,5.5,20.1,5.7,20,5.9z"/>
    <path d="M3,17h4c0.6,0,1-0.4,1-1s-0.4-1-1-1H3c-0.6,0-1,0.4-1,1S2.4,17,3,17z"/>
    <path d="M9,19H3c-0.6,0-1,0.4-1,1s0.4,1,1,1h6c0.6,0,1-0.4,1-1S9.6,19,9,19z"/>
    </symbol>
    <symbol id="pencil-square" viewBox="0 0 21 21">
    <path d='M5.72 14.456l1.761-.508 10.603-10.73a.456.456 0 0 0-.003-.64l-.635-.642a.443.443 0 0 0-.632-.003L6.239 12.635l-.52 1.82zM18.703.664l.635.643c.876.887.884 2.318.016 3.196L8.428 15.561l-3.764 1.084a.901.901 0 0 1-1.11-.623.915.915 0 0 1-.002-.506l1.095-3.84L15.544.647a2.215 2.215 0 0 1 3.159.016zM7.184 1.817c.496 0 .898.407.898.909a.903.903 0 0 1-.898.909H3.592c-.992 0-1.796.814-1.796 1.817v10.906c0 1.004.804 1.818 1.796 1.818h10.776c.992 0 1.797-.814 1.797-1.818v-3.635c0-.502.402-.909.898-.909s.898.407.898.91v3.634c0 2.008-1.609 3.636-3.593 3.636H3.592C1.608 19.994 0 18.366 0 16.358V5.452c0-2.007 1.608-3.635 3.592-3.635h3.592z'/>
    </symbol>
    <symbol id="people-circle" viewBox="0 0 16 16">
      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
    </symbol>
    <symbol id="grid" viewBox="0 0 16 16">
      <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
    </symbol>
     <symbol id="gear" viewBox="0 0 16 16">
     <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
     <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
     </symbol>
     <symbol id="copy" viewBox="0 0 16 16">
		 <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
     </symbol>
     <symbol id="user" viewBox="0 0 16 16">
     <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
     </symbol>
     <symbol id="closeDoor" viewBox="0 0 16 16">
     <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3zm1 13h8V2H4z"/>
     <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0"/>
     </symbol>
     <symbol id="signout" viewBox="0 0 16 16">
     <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
     <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
     </symbol>
     <symbol id="nohistory" viewBox="0 0 16 16">
     <path d="M3 4.5h10a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2m0 1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM1 2a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 2m0 12a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 14"/>
     </symbol>
     <symbol id="explore" viewBox="0 0 15 15">
     <path
    fill-rule="evenodd"
    clip-rule="evenodd"
    d="M2.8 1L2.74967 0.99997C2.52122 0.999752 2.32429 0.999564 2.14983 1.04145C1.60136 1.17312 1.17312 1.60136 1.04145 2.14983C0.999564 2.32429 0.999752 2.52122 0.99997 2.74967L1 2.8V5.2L0.99997 5.25033C0.999752 5.47878 0.999564 5.67572 1.04145 5.85017C1.17312 6.39864 1.60136 6.82688 2.14983 6.95856C2.32429 7.00044 2.52122 7.00025 2.74967 7.00003L2.8 7H5.2L5.25033 7.00003C5.47878 7.00025 5.67572 7.00044 5.85017 6.95856C6.39864 6.82688 6.82688 6.39864 6.95856 5.85017C7.00044 5.67572 7.00025 5.47878 7.00003 5.25033L7 5.2V2.8L7.00003 2.74967C7.00025 2.52122 7.00044 2.32429 6.95856 2.14983C6.82688 1.60136 6.39864 1.17312 5.85017 1.04145C5.67572 0.999564 5.47878 0.999752 5.25033 0.99997L5.2 1H2.8ZM2.38328 2.01382C2.42632 2.00348 2.49222 2 2.8 2H5.2C5.50779 2 5.57369 2.00348 5.61672 2.01382C5.79955 2.05771 5.94229 2.20045 5.98619 2.38328C5.99652 2.42632 6 2.49222 6 2.8V5.2C6 5.50779 5.99652 5.57369 5.98619 5.61672C5.94229 5.79955 5.79955 5.94229 5.61672 5.98619C5.57369 5.99652 5.50779 6 5.2 6H2.8C2.49222 6 2.42632 5.99652 2.38328 5.98619C2.20045 5.94229 2.05771 5.79955 2.01382 5.61672C2.00348 5.57369 2 5.50779 2 5.2V2.8C2 2.49222 2.00348 2.42632 2.01382 2.38328C2.05771 2.20045 2.20045 2.05771 2.38328 2.01382ZM9.8 1L9.74967 0.99997C9.52122 0.999752 9.32429 0.999564 9.14983 1.04145C8.60136 1.17312 8.17312 1.60136 8.04145 2.14983C7.99956 2.32429 7.99975 2.52122 7.99997 2.74967L8 2.8V5.2L7.99997 5.25033C7.99975 5.47878 7.99956 5.67572 8.04145 5.85017C8.17312 6.39864 8.60136 6.82688 9.14983 6.95856C9.32429 7.00044 9.52122 7.00025 9.74967 7.00003L9.8 7H12.2L12.2503 7.00003C12.4788 7.00025 12.6757 7.00044 12.8502 6.95856C13.3986 6.82688 13.8269 6.39864 13.9586 5.85017C14.0004 5.67572 14.0003 5.47878 14 5.25033L14 5.2V2.8L14 2.74967C14.0003 2.52122 14.0004 2.32429 13.9586 2.14983C13.8269 1.60136 13.3986 1.17312 12.8502 1.04145C12.6757 0.999564 12.4788 0.999752 12.2503 0.99997L12.2 1H9.8ZM9.38328 2.01382C9.42632 2.00348 9.49222 2 9.8 2H12.2C12.5078 2 12.5737 2.00348 12.6167 2.01382C12.7995 2.05771 12.9423 2.20045 12.9862 2.38328C12.9965 2.42632 13 2.49222 13 2.8V5.2C13 5.50779 12.9965 5.57369 12.9862 5.61672C12.9423 5.79955 12.7995 5.94229 12.6167 5.98619C12.5737 5.99652 12.5078 6 12.2 6H9.8C9.49222 6 9.42632 5.99652 9.38328 5.98619C9.20045 5.94229 9.05771 5.79955 9.01382 5.61672C9.00348 5.57369 9 5.50779 9 5.2V2.8C9 2.49222 9.00348 2.42632 9.01382 2.38328C9.05771 2.20045 9.20045 2.05771 9.38328 2.01382ZM2.74967 7.99997L2.8 8H5.2L5.25033 7.99997C5.47878 7.99975 5.67572 7.99956 5.85017 8.04145C6.39864 8.17312 6.82688 8.60136 6.95856 9.14983C7.00044 9.32429 7.00025 9.52122 7.00003 9.74967L7 9.8V12.2L7.00003 12.2503C7.00025 12.4788 7.00044 12.6757 6.95856 12.8502C6.82688 13.3986 6.39864 13.8269 5.85017 13.9586C5.67572 14.0004 5.47878 14.0003 5.25033 14L5.2 14H2.8L2.74967 14C2.52122 14.0003 2.32429 14.0004 2.14983 13.9586C1.60136 13.8269 1.17312 13.3986 1.04145 12.8502C0.999564 12.6757 0.999752 12.4788 0.99997 12.2503L1 12.2V9.8L0.99997 9.74967C0.999752 9.52122 0.999564 9.32429 1.04145 9.14983C1.17312 8.60136 1.60136 8.17312 2.14983 8.04145C2.32429 7.99956 2.52122 7.99975 2.74967 7.99997ZM2.8 9C2.49222 9 2.42632 9.00348 2.38328 9.01382C2.20045 9.05771 2.05771 9.20045 2.01382 9.38328C2.00348 9.42632 2 9.49222 2 9.8V12.2C2 12.5078 2.00348 12.5737 2.01382 12.6167C2.05771 12.7995 2.20045 12.9423 2.38328 12.9862C2.42632 12.9965 2.49222 13 2.8 13H5.2C5.50779 13 5.57369 12.9965 5.61672 12.9862C5.79955 12.9423 5.94229 12.7995 5.98619 12.6167C5.99652 12.5737 6 12.5078 6 12.2V9.8C6 9.49222 5.99652 9.42632 5.98619 9.38328C5.94229 9.20045 5.79955 9.05771 5.61672 9.01382C5.57369 9.00348 5.50779 9 5.2 9H2.8ZM9.8 8L9.74967 7.99997C9.52122 7.99975 9.32429 7.99956 9.14983 8.04145C8.60136 8.17312 8.17312 8.60136 8.04145 9.14983C7.99956 9.32429 7.99975 9.52122 7.99997 9.74967L8 9.8V12.2L7.99997 12.2503C7.99975 12.4788 7.99956 12.6757 8.04145 12.8502C8.17312 13.3986 8.60136 13.8269 9.14983 13.9586C9.32429 14.0004 9.52122 14.0003 9.74967 14L9.8 14H12.2L12.2503 14C12.4788 14.0003 12.6757 14.0004 12.8502 13.9586C13.3986 13.8269 13.8269 13.3986 13.9586 12.8502C14.0004 12.6757 14.0003 12.4788 14 12.2503L14 12.2V9.8L14 9.74967C14.0003 9.52122 14.0004 9.32429 13.9586 9.14983C13.8269 8.60136 13.3986 8.17312 12.8502 8.04145C12.6757 7.99956 12.4788 7.99975 12.2503 7.99997L12.2 8H9.8ZM9.38328 9.01382C9.42632 9.00348 9.49222 9 9.8 9H12.2C12.5078 9 12.5737 9.00348 12.6167 9.01382C12.7995 9.05771 12.9423 9.20045 12.9862 9.38328C12.9965 9.42632 13 9.49222 13 9.8V12.2C13 12.5078 12.9965 12.5737 12.9862 12.6167C12.9423 12.7995 12.7995 12.9423 12.6167 12.9862C12.5737 12.9965 12.5078 13 12.2 13H9.8C9.49222 13 9.42632 12.9965 9.38328 12.9862C9.20045 12.9423 9.05771 12.7995 9.01382 12.6167C9.00348 12.5737 9 12.5078 9 12.2V9.8C9 9.49222 9.00348 9.42632 9.01382 9.38328C9.05771 9.20045 9.20045 9.05771 9.38328 9.01382Z"
    />
     </symbol>
     <symbol id="xclose" viewBox="0 0 11 11">
     <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
     </symbol>
     <symbol id="trash" viewBox="0 0 16 16">
     <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
     <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
     </symbol>
     <symbol id="chatText" viewBox="0 0 16 16">
     <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
     <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
     </symbol>
     <symbol id="image" viewBox="0 0 16 16">
     <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
     <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12"/>
     </symbol>
     <symbol id="stop" viewBox="0 0 16 16">
     <path d="M3.5 5A1.5 1.5 0 0 1 5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11zM5 4.5a.5.5 0 0 0-.5.5v6a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 .5-.5V5a.5.5 0 0 0-.5-.5z"/>
     </symbol>
     <symbol id="downloadIcon" viewBox="0 0 16 16">>
     <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
     <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
     </symbol>
  </svg>

<!-- Sidebar -->
  <div class="p-2 rounded-0 col-lg-5 card border-0 sidebar mr-n1 mb-0" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel" style="width:265px;">
    <a href="#" class="d-flex align-items-center mb-3 mt-2 link-body-emphasis text-decoration-none" style="padding:10px 0 10px 10px;">
      <img src="./assets/img/logo.png" width="65" alt="" style="padding:0 12px 0 0;">
      <span class="fs-5">ChatBot AI</span>
    </a>
    <ul class="nav flex-column mb-auto ml-1 mr-1 bg-body-tertiary border" style="padding:20px;border-radius:13px;">
      <style>
        [disabled]{
        opacity: .8 !important;
        }
      </style>
     <button class="btn btn-primary mt-1 mb-2 saveChat newChat border-0 p-0 m-0 text-left">
      <li class="nav-item border-0">
        <a href="#" class="nav-link" style="padding:13px 17px;background-color:#6e74e5;color:aliceblue;border-radius:6.5px;">
        <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#pencil-square" />
          </svg>
          New Chat
        </a>
      </li>
      </button>
      <li class="nav-item pt-2 mb-n1">
        <p class="ml-3 mr-3 mt-2 mb-2">
        <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#history" />
          </svg>
          Chats History
        </p>
      </li>
      <hr class="ml-3 mr-3">
      <!-- load chat histry here -->
      <div id="chatHistory" class="w-100 autoscroll" style="max-height:calc(100vh - 77vh);overflow-y:scroll;user-select:none;">
      <span class='historySpinner d-block text-center mt-2 mb-1' style='font-size:18px;'> <i class='fas fa-spinner'></i></span>
      </div>
    </ul>


    <!-- theme -->
    <div class="dropup pl-3 pr-3 mb-2 ml-n3">
      <button type="btn"
        data-bs-toggle="dropdown"
        class="d-flex align-items-center bg-transparent"
        id="bd-theme"
        aria-expanded="false"
        aria-label="Toggle theme (auto)">
        <svg class="bi theme-icon-active col" height="1em" width="1em">
          <use href="#circle-half"></use>
        </svg>
        <span id="bd-theme-text" class="ml-2">Dark Mode</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" style="width:95%;border-radius:13px;" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em">
              <use href="#sun-fill"></use>
            </svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em">
              <use href="#check2"></use>
            </svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em">
              <use href="#moon-stars-fill"></use>
            </svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em">
              <use href="#check2"></use>
            </svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em">
              <use href="#circle-half"></use>
            </svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em">
              <use href="#check2"></use>
            </svg>
          </button>
        </li>
      </ul>
    </div>
    <hr class="ml-3 mr-3">
    <div class="dropup mb-2 pl-2 pr-2">
      <?php 
      if (isset($_SESSION['email']) && strlen($_SESSION['email']) != 0) {
        $currUser = $_SESSION['email'];
       
         $result = mysqli_query($con,"SELECT username FROM users WHERE email = '$currUser' LIMIT 1");
         $usern = mysqli_fetch_assoc($result);
        if($usern > 0) {
      ?>
      <button type="btn" class="bg-transparent w-100 d-flex align-items-center mt-2 justify-content-between" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="userName">
        <img src="./assets/img/user-icon.png" alt="" width="32" height="32" class="rounded-circle me-2">
          <?php
             $ellipsis = substr($usern['username'], 0, 17);
             echo "<span id='bd-theme-text' class='ml-1'>".strlen($usern['username']) > 17 ? $ellipsis."..." : $ellipsis.""."</span>";
          ?>
        </div>
        <i class="fas fa-ellipsis"></i>
      </button>
      <ul class="dropdown-menu text-small shadow" style="width:95%;border-radius:13px;">
        <li><a class="dropdown-item" href="signout.php">
           <svg class="bi pe-none me-1" width="16" height="16">
            <use xlink:href="#signout" />
          </svg> Sign Out</a></li>
      </ul>
      <?php
        }
      } else {
      ?>
      <a class="nav-link" href="user-sign.php">
      <div>
        <img src="./assets/img/user-icon.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <span id="bd-theme-text" class="ml-1">Sign In</span>
        </div>
      </a>
      <?php }?>
    </div>
  </div>

<!--Main container -->
  <div class="container-fluid flex-grow-1 p-3 m-2 justify-content-end align-items-center card bg-body-tertiary" style="border-radius:13px;">
	<div>
			<div class="direct-chat justify-content-end d-flex flex-column direct-chat-primary" id="chat_convo">
			<div class="position-absolute mt-4 ml-4 d-flex justify-content-between align-items-center top-0 start-0" id="navBarsContainer" style="display:none;">
			<a href="#" type="btn" class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" id="navBtn">
				<span class="dynamic-theme-bg"></span>
				<span class="dynamic-theme-bg"></span>
			</a>
			<a href="#" class="nav-link">ChatBot AI</a>
			<button class="btn bg-transparent border-0 saveChat newChat p-0 m-0">
			<a href="#" class="nav-link">
				<svg class="bi pe-none dynamic-theme-text" width="18" height="18">
                <use xlink:href="#pencil-square" />
                </svg>
		   </a>
		   </button>
		   </div>
              <!-- /.card-header -->
              <div class="card-body autoscroll" id="chatContent">
                <!-- Conversations are loaded here -->
                <div class="align-items-center" id="welcomeText" style="text-align:center;margin:0 0 17vh 0;">
                  <img src="./assets/img/logo.png" style="width:10rem" loading="lazy" alt="chatbot logo">
                  <?php
                  $res = $usern['username'] ?? "";
                  $firstname = explode(" ", $res)[0];
                            echo "<p class='pt-4'>Hi ".strtolower($firstname).", what can i help with?</span>";
                            ?>
                            </div>
                <div class="direct-chat-messages">
                </div>
                <div class="end-convo"></div>
                <!-- /.direct-chat-pane -->
              </div>
  
              <!-- /.card-body -->
			   <div class="row mb-2">
			   <div class="models-list ml-3 custom-bg">
						<style>
							.models-list{
								width:auto;
								margin-top:-3.5rem;
								border:1px solid #00000020;
								border-radius:10px;
								padding:3px 10px;
								z-index:999;
								line-height:50px;
								margin-bottom:10px;
								transition: all .1s;
								visibility: hidden;
							}
							.models-list button{
								font-size:15px;
								border-radius:8px;
								background-color:#252a2e;
							}
							.models-list .active{
								background-color: #6e74e5 !important;
								color: var(--bs-light);
							}
							.models-list button:hover{
								background-color: #6e74e5 !important;
								color: var(--bs-light);
							}
							.models-list button:active{
								transform: scale(.9);
							}
							[data-bs-theme="dark"] .custom-bg{
							    background-color: #252a2e;
                            }
                            [data-bs-theme="light"] .custom-bg{
                                background-color: #d9d9da;
                            }
						</style>
					<button class="btn bg-body-tertiary border qa active"><svg class="bi pe-none mt-1" width="16" height="16"><use xlink:href="#chatText"/></svg> Chat</button>
					<button class="btn bg-body-tertiary image-gen border"><svg class="bi pe-none mt-1" width="16" height="16"><use xlink:href="#image"/></svg> Create Image</button>
					</div>
				    <div class="col-12 d-flex modilesBtn justify-content-start pl-3">

            <!-- request loader indicator -->
          <div class="loaderDiv" style="font-size:14px;border-radius:15px;background-color:#00000035;border:1px solid #00000030 !important;"><div class="loader"></div></div>

					<style>
						.modilesBtn .active{
							background-color: #6e74e5 !important;
							color: var(--bs-light);
						}
					</style>
					<button class="btn mod-expl-btn" style="font-size:14px;border-radius:15px 15px 0 15px;background-color:#00000020;border:1px solid #00000020;">Explore
					<svg class="bi pe-none me-2 mb-1" width="17" height="17">
					<use xlink:href="#explore" />
					</svg>
					</button>
				</div>
			  </div>
              <div class="card-footer border pl-3 pr-3 ml-2 mr-2" style="border-radius:13px;">
                <form id="send_chat" method="post" novalidate>
                  <div class="input-group p-2">
                    <input type="text" id="userInput" name="message" style="height:3rem;" placeholder="Type here ..." class="form-control" required="">
					          <span class="currModel bg-body-tertiary border position-absolute end-0"><svg class="bi pe-none mt-1" width="16" height="16"><use xlink:href="#chatText"/></svg></span>
                    <span class="input-group-append">
                      <button type="submit" id="sendButton" class="btn btn-primary" style="padding:5px 15px;border-radius:0 5px 5px 0;"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top:8px;" width="18.5" height="18.5" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16"><path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/></svg></button>
                      <a href="#" id="stopButton" title="Stop" class="btn btn-primary" style="padding:5px 15px;"><svg class="bi pe-none" width="20" height="20"><use xlink:href="#stop"/></svg></a>
                    </span>
                  </div>
                </form>
              </div>
              <!-- /.card-footer-->
            </div>
		</div>

<div class="d-none" id="user_chat">
	<div class="direct-chat-msg right  ml-4">
        <img class="direct-chat-img border-1 border-primary" src="./assets/img/user-icon.png" alt="message user image">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text"></div>
        <!-- /.direct-chat-text -->
    </div>
</div>
<div class="d-none" id="bot_chat">
	<div class="direct-chat-msg bot-chat mr-4">
    <img class="direct-chat-img border-1 border-primary" src="./assets/img/logo.png" alt="message user image">
    <!-- /.direct-chat-img -->
		    <!-- copy btn -->
				<button style="font-size:14px;background-color: #00000020;border:1px solid #00000020;border-radius:10px 10px 10px 0;z-index:9999;margin-top:-40px;margin-left:50px;display:none;" class="btn icon-link icon-link-hover position-absolute copyBtn">
				Copy
				<svg class="bi" width="20" height="20" aria-hidden="true">
                <use xlink:href="#copy" />
                </svg>
			    </button>
        <div class="direct-chat-text" id="botRes"></div>
        <!-- /.direct-chat-text -->
  </div>
</div>
</div>

<!-- confirm delete chat btn -->
<div class="position-fixed text-center pt-3 confirmDelContainer" style="margin:0 auto;top:0;bottom:0;left:0;right:0;z-index:99999;background-color:#00000050;user-select:none;">
  <style>
    .deleteBtn:hover,
    .isdeleteBtn:hover{
      background-color: var(--danger) !important;
      opacity:.9;
    }
    .confirmDelContainer{
      display:none;
    }
  </style>
  <div class="alert alert-primary alert-dismissible d-inline-block fade show pr-4 pl-4 rounded-4"role="alert">
  Are you sure you want delete this chat?
  <br>
  <div class="confirmBtns" style="margin-top:15px;">
  <button type="button" class="btn btn-primary mr-n1 cancelBtn" style="font-size:13px;border-bottom-right-radius:0;border-top-right-radius:0;">
  <span aria-hidden="true">&times;</span> Cancel
  </button>
  <button type="button" class="btn btn-danger isdeleteBtn" style="font-size:13px;border-top-left-radius:0; border-bottom-left-radius:0;">
  <svg class='bi pe-none' width='13' height='13'>
  <use xlink:href='#trash' />
  </svg> Delete
  </button>
  </div>
</div>
</div>


<!-- js files -->
<script src="./assets/js/autoScroll.js"></script>
<script type="text/javascript">
	// reset & save all chat btns
	let newChatBtns = document.querySelectorAll(".newChat");

	
	// explore models btn
	let modExplBtn = document.querySelector('.mod-expl-btn');
	let modelsListContainer = document.querySelector('.models-list');
	let currModel = document.querySelector('.currModel');

  // chech if create image model active
  let isImage = 'no';
	
	let qa = document.querySelector('.qa');
	let imageGen = document.querySelector('.image-gen');
	
	modExplBtn.addEventListener('click', ()=> {
		if (modExplBtn.classList.contains('active')) {
			modExplBtn.classList.remove("active");
			modExplBtn.innerHTML = `Explre <svg class="bi pe-none me-2 mb-1" width="17" height="17"><use xlink:href="#explore"/></svg>`;
			modelsListContainer.style.visibility = "hidden";
		} else {
			modExplBtn.classList.add("active");
			modExplBtn.innerHTML = `Close <svg class="bi pe-none me-2 mb-1" width="17" height="17"><use xlink:href="#xclose"/></svg>`;
			modelsListContainer.style.visibility = "visible";
		}
	})

	qa.addEventListener('click', ()=> {
		qa.classList.add('active')
		imageGen.classList.remove('active');
		currModel.innerHTML = `<svg class="bi pe-none mt-1" width="16" height="16"><use xlink:href="#chatText"/></svg>`;
		modelsListContainer.style.visibility = "hidden";
		modExplBtn.classList.remove("active");
		modExplBtn.innerHTML = `Explre <svg class="bi pe-none me-2 mb-1" width="17" height="17"><use xlink:href="#explore"/></svg>`;

    isImage = 'no';
	})
	imageGen.addEventListener('click', ()=> {
		imageGen.classList.add('active')
		qa.classList.remove('active');
		currModel.innerHTML = `<svg class="bi pe-none" style="margin-top:2px" width="16" height="16"><use xlink:href="#image"/></svg>`;
		modelsListContainer.style.visibility = "hidden";
		modExplBtn.classList.remove("active");
		modExplBtn.innerHTML = `Explre <svg class="bi pe-none me-2 mb-1" width="17" height="17"><use xlink:href="#explore"/></svg>`;

    isImage = 'yes';
	})
	


   

	let sidebar = document.querySelector('.sidebar');
	function startiSidebar(){
		let e = window.matchMedia("(max-width: 990px)");
		if(e.matches){
			sidebar.classList.add('offcanvas');
			sidebar.classList.add('offcanvas-start');
		} else {
			sidebar.classList.remove('offcanvas');
			sidebar.classList.remove('offcanvas-start');
		}

	   document.querySelectorAll('.copyBtn').forEach((btn) => {
       btn.style.display = "none";
       })
	}
	startiSidebar();
	window.addEventListener("resize", startiSidebar);

	// store all chats
	let allResponse = {
			user : [],
			bot : []
	};

	$(document).ready(function(){
	document.addEventListener('focus', ()=> {
    document.querySelectorAll('.copyBtn').forEach((btn) => {
    btn.style.display = "none";
    })
	})
		document.getElementById("userInput").oninput = function(){
			document.querySelectorAll('.copyBtn').forEach((btn) => {
      btn.style.display = "none";
      })
		}
		
		// save full chat
		for (let newChatBtn of newChatBtns) {
		newChatBtn.addEventListener('click', ()=>{
		let booots = $("#botRes");
		for (const boot of booots) {
		if (boot.innerHTML != "") {
		let data = JSON.stringify(allResponse);
		jQuery.ajax({
		url: "./ajex_validators/saveChat.php",
		type: "POST",
		data: {data},
		success: function(response){
      loadChatSummary();
      allResponse = {
			user : [],
			bot : []
	    }; 
		},
		error: function (){}
		});
		}
		}
		})
	  }
		

		$('#send_chat').submit(function(e){
      			
			if(document.getElementById("userInput").value !== ''){
      $('.loaderDiv').show();
      $('#sendButton').hide();
      document.getElementById('stopButton').style.display = 'flex';
				sendButton.setAttribute('disabled', 'true');
				if (document.getElementById("botRes").innerHTML == "") {
				document.getElementById("welcomeText").style.display = "none";
			}
			}
			e.preventDefault();
			let message = $('[name="message"]').val();
			if(message == '' || message == null) return false;
			var uchat = $('#user_chat').clone();
			uchat.find('.direct-chat-text').html(message);

			$("#chat_convo .direct-chat-messages").append(uchat.html());
			$('[name="message"]').val('')
			$("#chat_convo .card-body").animate({ scrollTop: $("#chat_convo .card-body").prop('scrollHeight') }, "fast");

      // Request to the server
			const req = $.ajax({
				url: "./ajex_validators/getResponse.php",
				method:'POST',
				data: {message, isImage},
				error: (err, textStatus)=>{
        if (textStatus === "abort") {
        console.log('Req aborted!');
        $('#stopButton').hide();
        $(".loaderDiv").hide();
        $('#sendButton').show();
        sendButton.removeAttribute('disabled');

        let bot_chat = $('#bot_chat').clone(); 
        bot_chat.find('.direct-chat-text').html("Hmm... someting seems to have gone wrong.");
        $('#chat_convo .direct-chat-messages').append(bot_chat.html());
        $("#chat_convo .card-body").animate({ scrollTop: $("#chat_convo .card-body").prop('scrollHeight') }, "fast");

        // add disabled attribute on saveChat or newChat btns
        for (let saveChatBtn of newChatBtns) {
        saveChatBtn.setAttribute('disabled','true');
        }
        } else {
          console.log(err)
        }
				},
				success:function(resp){
    
        $('#stopButton').hide();
        $(".loaderDiv").hide();
        $('#sendButton').show();
        sendButton.removeAttribute('disabled');
    
				let match = /Network error. Please check your internet!|Something error whith APi!/igm;
        if (match.test(resp)) {
        let bot_chat = $('#bot_chat').clone();
        bot_chat.find('.direct-chat-text').html(resp);
        $('#chat_convo .direct-chat-messages').append(bot_chat.html());
        $("#chat_convo .card-body").animate({ scrollTop: $("#chat_convo .card-body").prop('scrollHeight') }, "fast");
      
        // add disabled attribute on saveChat or newChat btns
        for (let saveChatBtn of newChatBtns) {
          saveChatBtn.setAttribute('disabled','true');
        }
        // clear it
        allResponse = {
        user : [],
        bot : []
        };
        } else {
        // store all user chats
        allResponse.user.push(message);

        let bot_chat = $('#bot_chat').clone();
        bot_chat.find('.direct-chat-text').html(resp);
        $('#chat_convo .direct-chat-messages').append(bot_chat.html());
        $("#chat_convo .card-body").animate({ scrollTop: $("#chat_convo .card-body").prop('scrollHeight') }, "fast");
        // remove disabled attribute on saveChat or newChat btns
        for (let saveChatBtn of newChatBtns) {
          saveChatBtn.removeAttribute('disabled');
        }
        }
	
        // store all bot chats
        allResponse.bot.push(resp);

				loadCopyBtn();
				}
			})

      // Button to cancel the request
     $('#stopButton').click(function() {
         if (req) {
         req.abort();
         }
      });
		})

	})

	function loadCopyBtn(){
	let copyBtns = document.querySelectorAll('.copyBtn');
				let holdTimer;
				let isTouching = false;
				document.querySelectorAll(".bot-chat .direct-chat-text").forEach((elm) => {
				let startHold = (event) => {
				copyBtns.forEach((btn) => {
				 btn.addEventListener("click", () => {
                 let textToCopy = event.target.innerHTML;
                 navigator.clipboard.writeText(textToCopy).then(() => {
                    copyBtns.forEach((btns) => {
                    btns.style.display = "none";
                    })
                 });
                 });
				isTouching = true;
				let touch = event.touches ? event.touches[0] : event;
				holdTimer = setTimeout(() => {
					if (isTouching) {
						btn.style.display = "block";
					}
				}, 400);

				})
				};
				let endHold = () => {
					isTouching = false;
					clearTimeout(holdTimer);
				};
				let cancelHold = () => {
					isTouching = false;
					clearTimeout(holdTimer);
				};
				elm.addEventListener("mousedown", startHold);
				elm.addEventListener("touchstart", startHold);
				document.addEventListener("mouseup", endHold);
				document.addEventListener("touchend", endHold);
				elm.addEventListener("mousemove", cancelHold);
				elm.addEventListener("touchmove", cancelHold);
				})
	}

  
    // save chat btns
    let saveChatBtns = document.querySelectorAll('.saveChat');

          // clear chat
          function clearChat(){
          $("#chat_convo .direct-chat-messages").empty();
            }

          // Load chats summary when a button is clicked
            function loadChatSummary() {
            fetch(`./ajex_validators/getChatSummary.php`)
                .then(response => response.text())
                .then(data => {
                let match = /No internet connection!/igm;
                if (match.test(data)) {
                  updateConnection();
                } else {
                  clearChat();
                  $('#chatHistory').html(data);
              
                  $('[name="message"]').val('');

                  document.getElementById("welcomeText").style.display = "block";  
               }
               });
               }
              loadChatSummary();

                // Load full chat when a button is clicked
                function loadChat(chatId) {
                fetch(`./ajex_validators/getChat.php?id=${chatId}`)
                .then(response => response.json())
                .then(data => {
                  $("#chat_convo .card-body").animate({ scrollTop: $("#chat_convo .card-body").prop('scrollHeight') }, "fast");
                  clearChat();
                  console.log(data);
                  data.user.forEach((msg, index) => {
                  let uchat = $('#user_chat').clone();
                  uchat.find('.direct-chat-text').html(msg);
                  $("#chat_convo .direct-chat-messages").append(uchat.html());

                  let bot_chat = $('#bot_chat').clone();
                  bot_chat.find('.direct-chat-text').html(data.bot[index]);
                  $('#chat_convo .direct-chat-messages').append(bot_chat.html());

                  })

                  $('[name="message"]').val('');

                  loadCopyBtn();

                  document.getElementById("welcomeText").style.display = "none";  
                });

                for (const saveChatBtn of saveChatBtns) {
                  saveChatBtn.setAttribute('disabled', 'true');
                }
                }


                let confirmDelContainer = document.querySelector('.confirmDelContainer');
                let cancel = document.querySelector('.cancelBtn');
                let isdeleteBtn = document.querySelector('.isdeleteBtn');

                cancel.addEventListener('click', ()=> {
                    confirmDelContainer.style.display = "none";
                  })
            
                function deleteChat(chatId) {
                confirmDelContainer.style.display = "block";
                isdeleteBtn.addEventListener('click', ()=> {
                fetch('./ajex_validators/deleteChat.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${chatId}`
                })
                .then(response => response.text())
                .then(data => {
                  loadChatSummary();
                  confirmDelContainer.style.display = "none";
                })
                .catch(error => console.error('Error:', error));
                  })
               }
     
    </script>
</body>
</html>