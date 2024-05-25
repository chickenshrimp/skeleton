const submitButtonLogin = document.querySelector('.submitLog');
const loginInp = document.getElementById('login');
const passwordInp = document.getElementById('password');

submitButtonLogin.addEventListener('click', () => {
    if (loginInp.value === ''){
        alert("Вы не ввели логин");
    }
    else if(passwordInp.value === ''){
        alert("Вы не ввели пароль");
    }
})
const redirectToMainFont = document.querySelector('.title-name');

redirectToMainFont.addEventListener('click', () => {
    window.location.href = '/';
})
const notRegisteredYet = document.getElementById('registry');
notRegisteredYet.addEventListener('click', ()=> {
    window.location.href = '/registration';
})