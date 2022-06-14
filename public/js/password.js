function mostrar(){

    let password = document.querySelector('#password');
    let btn      = document.querySelector('#btn-eye');
    let abbr     = document.querySelector('#abrev');


    if(password.type == 'password'){
        password.type    = 'text';
        btn.name = 'eye-off-outline';
        abbr.title    = 'Ocultar senha';
    } else{
        password.type = 'password';
        btn.name = 'eye-outline';
        abbr.title    = 'Mostrar senha';
    }
}

function check(){
    let btnRegister = document.querySelector('#btn-register');
    let password = document.querySelector('#password').value;
    let passwordConf = document.querySelector('#passwordConf').value;

    if(password != passwordConf || password == "" || passwordConf == ""){
        btnRegister.setAttribute('disabled', 'disabled');
    } else{
        btnRegister.removeAttribute("disabled");
    }
}