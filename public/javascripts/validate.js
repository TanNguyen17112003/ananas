const form = document.getElementById('form');

form.addEventListener('submit', e => {
	e.preventDefault();
	checkInputs();
});

function checkInputs() {
	validateEmail();
	validateName();
	validatePhone();
	validatePassword();
}

function validateEmail(){
	const email = document.getElementById('email');
	const emailValue = email.value.trim();

	if(emailValue === '') {
		setErrorFor(email, 'Email cannot be blank');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Not a valid email');
	} else {
		setSuccessFor(email);
	}
}

function validateName(){
	const name = document.getElementById('name');
	const nameValue = name.value.trim();
	if(nameValue === '') {
		setErrorFor(name, 'Username cannot be blank');
	} else {
		setSuccessFor(name);
	}
}

function validatePhone(){
	const phone = document.getElementById('phone');
	const phoneValue = phone.value.trim();
	if(phoneValue === '') {
		setErrorFor(phone, 'Phone cannot be blank');
	} else if (phoneValue.length != 10) {
		setErrorFor(phone, 'Phone must be contained in 10 numbers');
	} else {
		setSuccessFor(phone);
	}
}

function validatePassword() {
	const password = document.getElementById('password');
	const passwordValue = password.value.trim();
	if(passwordValue === '') {
		setErrorFor(password, 'Password cannot be blank');
	} else {
		setSuccessFor(password);
	}
}

function validateRePassword() {
	const password2 = document.getElementById('password2');
	const password2Value = password2.value.trim();
	const password = document.getElementById('password');
	const passwordValue = password.value.trim();
	if(password2Value === '') {
		setErrorFor(password2, 'Re-password cannot be blank');
	} else if(passwordValue !== password2Value) {
		setErrorFor(password2, 'Passwords does not match');
	} else{
		setSuccessFor(password2);
	}
}

function setErrorFor(input, message) {
	const inputGroup = input.parentElement;
	const small = inputGroup.querySelector('small');
	input.className = 'form-control error';
	small.className = 'error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const inputGroup = input.parentElement;
	input.className = 'form-control success';
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

