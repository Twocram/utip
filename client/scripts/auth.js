const logBtn = document.getElementById('login-btn');
const regBtn = document.getElementById('reg-btn');

const logForm = {
  email: document.getElementById('email-login'),
  password: document.getElementById('password-login'),
};

const regForm = {
  email: document.getElementById('email-reg'),
  password: document.getElementById('password-reg'),
};

logBtn.addEventListener('click', () => authUser(), false);
regBtn.addEventListener('click', () => createUser(), false);

async function authUser() {
  const res = await fetch(
    'http://localhost/utip-test/api/v1/users?' +
      new URLSearchParams({
        email: logForm.email.value,
        password: logForm.password.value,
      })
  );

  const user = await res.json();
  if (!user.status)
    window.location.replace('http://localhost/utip-test/client/index.php');
}

async function createUser() {
  let formData = new FormData();
  formData.append('email', regForm.email.value);
  formData.append('password', regForm.password.value);

  const res = await fetch('http://localhost/utip-test/api/v1/users', {
    method: 'POST',
    body: formData,
  });

  const data = await res.json();
  if (data.status)
    window.location.replace('http://localhost/utip-test/client/index.php');
}
