const passwordInputs = document.querySelectorAll('input[type="password"]');
const togglePassVisibility = document.querySelectorAll('.togglePassVisibility');

// Toggle Password Visibility
for (let togglePassVisibilities of togglePassVisibility) {
    togglePassVisibilities.addEventListener('click', () => {
        for (let passwordInput of passwordInputs) {
            if (passwordInput.type === "password") {
                passwordInput.type = "text"; 
                togglePassVisibilities.className = "fas fa-eye";
            } else {
                passwordInput.type = "password"; 
                togglePassVisibilities.className = "fas fa-eye-slash";
            }
                        
        }
    })
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
}
})


for (let inputs of formInputs) {
    inputs.addEventListener('focus', () => {
    closePopUp();
    })
}