function hiddenPassword(){
var btnHiddenPassword = document.getElementById('btn-password');
var checkHiddenPassword = document.getElementById('check-password');
var password = document.getElementById('password');
var rePassword = document.getElementById('repassword');

    if (checkHiddenPassword.checked == true) {
        password.type = "text";
        rePassword.type = "text";
        btnHiddenPassword.classList.replace('bg-none', 'bg-info');
        btnHiddenPassword.classList.add('text-white');
    }else{
        password.type = "password";
        rePassword.type = "password";
        btnHiddenPassword.classList.replace('bg-info', 'bg-none');
        btnHiddenPassword.classList.remove('text-white');
    }
}

function hiddenPassword2(){
var btnHiddenPassword2 = document.getElementById('btn-password2');
var checkHiddenPassword2 = document.getElementById('check-password2');
var password2 = document.getElementById('password2');

    if (checkHiddenPassword2.checked == true) {
        password2.type = "text";
        btnHiddenPassword2.classList.replace('bg-none', 'bg-info');
        btnHiddenPassword2.classList.add('text-white');
    }else{
        password2.type = "password";
        btnHiddenPassword2.classList.replace('bg-info', 'bg-none');
        btnHiddenPassword2.classList.remove('text-white');
    }
}