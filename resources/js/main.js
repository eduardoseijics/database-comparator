const btnCopyCredentials = document.querySelectorAll('[data-copy]');
btnCopyCredentials.forEach(button => {
  button.addEventListener('click', function(e) {
    console.log(this.dataset.copy);
  })
})

const btnClean = document.querySelectorAll('[data-clean]');
btnClean.forEach(button => {
  button.addEventListener('click', function(e) {
    e.preventDefault()
    const cardId = this.dataset.clean;
    const allInputs = document.querySelectorAll(`#card-${cardId} input`);

    allInputs.forEach(singleInput => singleInput.value = '');
  })
})