<?php
require_once(__DIR__."/../config/auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Change Password | FireArena</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

<?php include("../includes/navbar.php"); ?>

<div class="container mt-5 mb-5">

<div class="row justify-content-center">

<div class="col-lg-6">

<div class="card shadow border-0">

<div class="card-header bg-dark text-white">

<h3 class="mb-0">

<i class="bi bi-shield-lock-fill"></i>

Change Password

</h3>

</div>

<div class="card-body">

<div id="message"></div>

<form id="changePasswordForm">

<div class="mb-3">

<label class="form-label">

Current Password

</label>

<div class="input-group">

<input

type="password"

name="current_password"

id="current_password"

class="form-control"

required>

<button

class="btn btn-outline-secondary"

type="button"

onclick="togglePassword('current_password',this)">

<i class="bi bi-eye"></i>

</button>

</div>

</div>

<div class="mb-3">

<label class="form-label">

New Password

</label>

<div class="input-group">

<input

type="password"

name="new_password"

id="new_password"

class="form-control"

required>

<button

class="btn btn-outline-secondary"

type="button"

onclick="togglePassword('new_password',this)">

<i class="bi bi-eye"></i>

</button>

</div>

<div class="progress mt-2" style="height:8px;">

<div

id="strengthBar"

class="progress-bar"

style="width:0%">

</div>

</div>

<small id="strengthText" class="text-muted">

Password Strength

</small>

</div>

<div class="mb-3">

<label class="form-label">

Confirm Password

</label>

<div class="input-group">

<input

type="password"

name="confirm_password"

id="confirm_password"

class="form-control"

required>

<button

class="btn btn-outline-secondary"

type="button"

onclick="togglePassword('confirm_password',this)">

<i class="bi bi-eye"></i>

</button>

</div>

</div>

<div class="d-flex justify-content-between">

<a href="profile.php" class="btn btn-secondary">

Back

</a>

<button

type="submit"

class="btn btn-primary"

id="saveBtn">

<i class="bi bi-check-circle"></i>

Change Password

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

function togglePassword(id,btn){

let input=document.getElementById(id);

let icon=btn.querySelector("i");

if(input.type==="password"){

input.type="text";

icon.classList.remove("bi-eye");

icon.classList.add("bi-eye-slash");

}else{

input.type="password";

icon.classList.remove("bi-eye-slash");

icon.classList.add("bi-eye");

}

}

document.getElementById("new_password").addEventListener("keyup",function(){

let password=this.value;

let bar=document.getElementById("strengthBar");

let text=document.getElementById("strengthText");

let score=0;

if(password.length>=8) score++;

if(/[A-Z]/.test(password)) score++;

if(/[a-z]/.test(password)) score++;

if(/[0-9]/.test(password)) score++;

if(/[^A-Za-z0-9]/.test(password)) score++;

if(score<=2){

bar.style.width="30%";

bar.className="progress-bar bg-danger";

text.innerHTML="Weak Password";

}
else if(score==3){

bar.style.width="60%";

bar.className="progress-bar bg-warning";

text.innerHTML="Medium Password";

}
else{

bar.style.width="100%";

bar.className="progress-bar bg-success";

text.innerHTML="Strong Password";

}

});

document.getElementById("changePasswordForm").addEventListener("submit",function(e){

e.preventDefault();

let btn=document.getElementById("saveBtn");

btn.disabled=true;

btn.innerHTML="Updating...";

let formData=new FormData(this);

fetch("../ajax/change-password.php",{

method:"POST",

body:formData

})

.then(res=>res.json())

.then(data=>{

btn.disabled=false;

btn.innerHTML="Change Password";

if(data.status=="success"){

document.getElementById("message").innerHTML=

`<div class="alert alert-success">${data.message}</div>`;

document.getElementById("changePasswordForm").reset();

document.getElementById("strengthBar").style.width="0%";

document.getElementById("strengthText").innerHTML="Password Strength";

}
else{

document.getElementById("message").innerHTML=

`<div class="alert alert-danger">${data.message}</div>`;

}

});

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
