function mostrar(){

    var password = document.querySelector('#password');
    var btn      = document.querySelector('#btn-eye');
    var abbr     = document.querySelector('#abrev');


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