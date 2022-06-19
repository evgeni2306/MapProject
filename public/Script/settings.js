let errorBlockText = document.querySelector('.error-block__text');
let errorBlock = document.querySelector('.error-block');

if (errorBlockText.textContent.trim() !== "") {
    errorBlock.classList.remove('hide');
} else {
    errorBlock.classList.add('hide');
}
