const logoutBtn = document.querySelector('.header-sub__link');
logoutBtn.addEventListener('click', async function (e) {
  e.preventDefault(e);
  await logout();
});

async function logout() {
  const res = await fetch('http://localhost/utip-test/api/v1/users/logout');
  window.location.replace('http://localhost/utip-test/client/auth.php');
}
