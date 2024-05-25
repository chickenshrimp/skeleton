const submitButtonLogin = document.querySelector('.submitReg');
const loginInp = document.getElementById('login');
const passwordInp = document.getElementById('password');
const nameInp = document.getElementById('name');
const surnameInp = document.getElementById('surname');

submitButtonLogin.addEventListener('click', () => {
    if (loginInp.value === ''){
        alert("Вы не ввели логин");
    }
    else if(passwordInp.value === ''){
        alert("Вы не ввели пароль");
    }
    else if(nameInp.value === ''){
        alert("Вы не ввели имя");
    }
    else if(surnameInp.value === ''){
        alert("Вы не ввели фамилию");
    }
})

const notRegisteredYet = document.getElementById('registry');
notRegisteredYet.addEventListener('click', ()=> {
    window.location.href = '/registration';
})