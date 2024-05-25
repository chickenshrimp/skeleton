const redirectToMainFont = document.querySelector('.main-name-project');

redirectToMainFont.addEventListener('click', () => {
    window.location.href = '/';
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