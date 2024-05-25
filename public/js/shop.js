const addButton = document.getElementById('add-button');
const reduceButton = document.getElementById('reduce-button');
//add in order with twig
const loginButton = document.querySelector('.login-info');

loginButton.addEventListener('click', () => {
    window.location.href = '/my-account';
})

const redirectToMainFont = document.querySelector('.main-name-project');

redirectToMainFont.addEventListener('click', () => {
    window.location.href = '/';
})

const allAddButtons = document.getElementsByName('add-button');
const allReduceButtons = document.getElementsByName('reduce-button');
const colvo = document.getElementsByName('num-of-goods');
const addBasket = document.getElementsByName('add-to-basket');

allAddButtons.forEach(button => {
    button.addEventListener('click', () => {
        let id = button.id;
        colvo.forEach(el => {
            if(el.id === id){
                el.value++;
            }
        })
    })
})

allReduceButtons.forEach(button => {
    button.addEventListener('click', () => {
        let id = button.id;
        colvo.forEach(el => {
            if(el.id === id && parseInt(el.innerText) !== 0){
                el.value--;
            }
        })
    })
})

addBasket.forEach(button => {
    button.addEventListener('click', () => {
        let id = button.id;
        colvo.forEach(el => {
            if(el.id === id && parseInt(el.innerText) !== 0){
                el.innerText = 0;
            }
        })
    })
})

const allShopsButton = document.querySelector('.select-confirm');
const allShopsSelect = document.querySelector('.chosen');
const allShopsSelectOpts = document.querySelectorAll('.shop-select');

allShopsButton.addEventListener('click', () => {
    if(allShopsSelect.value !== 'Все магазины'){
        allShopsSelectOpts.forEach(item => {
            if(item.innerText === allShopsSelect.value){
                window.location.href = `/shop/${item.id}`;
            }
        })
    }

})