const loginButton = document.querySelector('.login-info');

loginButton.addEventListener('click', () => {
    window.location.href = '/my-account';
})

const allItems = document.querySelectorAll('.item');

allItems.forEach(item => {
    item.addEventListener('click', () => {
        window.location.href = `/shop/${item.id}`;
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