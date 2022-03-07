function show_hide_password(target){
  let input = document.getElementById('password-input');
  if (input.getAttribute('type') == 'password') {
    target.classList.add('view');
    input.setAttribute('type', 'text');
  } else {
      target.classList.remove('view');
      input.setAttribute('type', 'password');
    }
  return false;
}

let errorBlockText = document.querySelector('.error-block__text');
let errorBlock = document.querySelector('.error-block');

if (errorBlockText.textContent.trim() !== "") {
  errorBlock.classList.remove('hide');
} else {
    errorBlock.classList.add('hide');
}