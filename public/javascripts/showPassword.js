const togglePassword = document.getElementById("toggle-password");
const togglePassword2 = document.getElementById("toggle-password2");
const togglePassword3 = document.getElementById("toggle-password3");
const password = document.getElementById("password");
const password2 = document.getElementById("password2");
const password3 = document.getElementById("password3");

togglePassword.addEventListener("click",TogglePasswordVisibility);
if (togglePassword2 != null){
    togglePassword2.addEventListener("click",TogglePassword2Visibility);
}
if (togglePassword3 != null){
    togglePassword3.addEventListener("click",TogglePassword3Visibility);
}

function TogglePasswordVisibility(){
    if (password.type == "password"){
        password.type = "text";
    }else{
        password.type = "password";
    }
    this.classList.toggle('fa-eye-slash');
}
function TogglePassword2Visibility(){
    if (password2.type == "password"){
        password2.type = "text";
    }else{
        password2.type = "password";
    }
    this.classList.toggle('fa-eye-slash');
}
function TogglePassword3Visibility(){
    if (password3.type == "password"){
        password3.type = "text";
    }else{
        password3.type = "password";
    }
    this.classList.toggle('fa-eye-slash');
}