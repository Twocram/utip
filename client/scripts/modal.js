const modalBtn = document.querySelector('.modal-btn');

const modal = document.querySelector('.modal-window');

const closeBtn = document.querySelector('.close-btn');

modalBtn.addEventListener('click', function () {
  modal.classList.add('active');
});

closeBtn.addEventListener('click', function () {
  modal.classList.remove('active');
});
