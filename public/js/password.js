//Função para mostrar a senha com o icone de olho com Onclick
function mostrar(){
    //Variaveis recebendo objetos do html
    var senha = document.getElementById('senha');
    var btn   = document.getElementById('btn-eye');
    var abbr  = document.getElementById('abrev');

    //Se a input da senha for igual a password, muda pra tipo texto, muda o icone e a abreviação
    if(senha.type == 'password'){
        senha.type    = 'text';
        btn.name = 'eye-off-outline';
        abbr.title    = 'Ocultar senha';
    //Se a input da senha for igual a text, muda pra tipo password, muda o icone e a abreviação 
    } else{
        senha.type = 'password';
        btn.name = 'eye-outline';
        abbr.title    = 'Mostrar senha';
    }
}

//Função para mostrar a senha com o icone de olho com Onclick
function mostrar1(){
    //Variaveis recebendo objetos do html
    var cad_senha0 = document.getElementById('senha_usuario');
    var btn        = document.getElementById('btn-eye');
    var abbr       = document.getElementById('abrev');

    //Se a input da senha for igual a password, muda pra tipo texto, muda o icone e a abreviação
    if(cad_senha0.type == 'password'){
        cad_senha0.type = 'text';
        btn.classList = 'fas fa-eye';
        abbr.title    = 'Ocultar senha';
    //Se a input da senha for igual a text, muda pra tipo password, muda o icone e a abreviação
    } else{
        cad_senha0.type = 'password';
        btn.classList = 'fas fa-eye-slash';
        abbr.title    = 'Mostrar senha';
    }
}

//Função para mostrar a senha com o icone de olho com Onclick
function mostrar2(){
    //Variaveis recebendo objetos do html
    var cad_senha1 = document.getElementById('confSenha_usuario');
    var btn        = document.getElementById('btn-eyee');
    var abbr       = document.getElementById('abrevi');

    //Se a input da senha for igual a password, muda pra tipo texto, muda o icone e a abreviação
    if(cad_senha1.type == 'password'){
        cad_senha1.type = 'text';
        btn.classList = 'fas fa-eye';
        abbr.title    = 'Ocultar senha';
    //Se a input da senha for igual a text, muda pra tipo password, muda o icone e a abreviação
    } else{
        cad_senha1.type = 'password';
        btn.classList = 'fas fa-eye-slash';
        abbr.title    = 'Mostrar senha';
    }
}