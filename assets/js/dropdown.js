var select = function () {
    let selectHeader = document.querySelectorAll('.select__header');
    let selectItem = document.querySelectorAll('.select__item');

    selectHeader.forEach(item=>{
        item.addEventListener('click', selectToggle)
    });

    selectItem.forEach(item=>{
        item.addEventListener('click', selectChoose)
    });

    function selectToggle() {
        this.parentElement.classList.toggle('active');
    };

    function selectChoose() {
        // this.parentElement.classList.toggle('active');
        let text = this.innerText,
        select = this.closest('.select')
        currentText = this.closest('.select').querySelector('.select__current');
        currentText.innerText = text;
        select.classList.remove('active');
        console.log(text);
    };

    
};

// select();