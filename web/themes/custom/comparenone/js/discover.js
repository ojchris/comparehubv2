const items = document.querySelectorAll('[data-for-dialog]');
items.forEach(item => {
  item.addEventListener('click', function (e) {
    console.log(e, `#${item.dataset.forDialog}`);
    document.querySelector(`#${item.dataset.forDialog}`).classList.add('dialog-opened');

    document.querySelector(`#${item.dataset.forDialog}`).classList.add('animate__animated');
    document.querySelector(`#${item.dataset.forDialog}`).classList.add('animate__fadeIn');

    document.querySelector(`#${item.dataset.forDialog} .dialog-container`).classList.add('animate__animated');
    document.querySelector(`#${item.dataset.forDialog} .dialog-container`).classList.add('animate__slideInRight');
  })
});



const dialogCloseIcons = document.querySelectorAll('[data-modal-id]');
dialogCloseIcons.forEach(dialogCloseIcon => {
  dialogCloseIcon.addEventListener('click', function (e) {
    console.log(e, `#${dialogCloseIcon.dataset.modalId}`);
    document.querySelector(`#${dialogCloseIcon.dataset.modalId}`).classList.remove('dialog-opened');

    document.querySelector(`#${dialogCloseIcon.dataset.modalId}`).classList.remove('animate__animated');
    document.querySelector(`#${dialogCloseIcon.dataset.modalId}`).classList.remove('animate__fadeIn');
    
    document.querySelector(`#${dialogCloseIcon.dataset.modalId} .dialog-container`).classList.remove('animate__animated');
    document.querySelector(`#${dialogCloseIcon.dataset.modalId} .dialog-container`).classList.remove('animate__slideInRight');
  })
});