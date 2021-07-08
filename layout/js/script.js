const toggleMenu = document.querySelector('#user-dropdown .menu');
const body = document.querySelector('body');
document.addEventListener('click', (e) => {
  if (e.target.closest('.menu') || e.target.localName === 'img') return;
  if (toggleMenu) {
    toggleMenu.classList.remove('active');
  }
});
function menuToggle() {
  toggleMenu.classList.toggle('active');
}

function register() {
  document.getElementById('submit').disabled = true;
  const formElement = document.querySelectorAll('.form-data');
  const formData = new FormData();
  for (let i = 0; i < formElement.length; i++) {
    formData.append(formElement[i].name, formElement[i].value);
  }
  // console.log([...formData]);

  const ajaxRequest = new XMLHttpRequest();
  ajaxRequest.open('POST', 'process-data.php');
  ajaxRequest.send(formData);

  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState === 4 && ajaxRequest.status === 200) {
      document.getElementById('submit').disabled = false;

      const response = JSON.parse(ajaxRequest.responseText);

      if (response.success) {
        document.getElementById('register-form').reset();
        document.getElementById('message').innerHTML = response.success;
        setTimeout(() => {
          document.getElementById('message').innerHTML = '';
        }, 2000);
        document.getElementById('name-error').innerHTML = '';
        document.getElementById('email-error').innerHTML = '';
        document.getElementById('password-error').innerHTML = '';
        document.getElementById('password-con-error').innerHTML = '';
        document.getElementById('switch-login').focus();
      } else {
        // display validation error
        document.getElementById('name-error').innerHTML = response.username;
        document.getElementById('email-error').innerHTML = response.email;
        document.getElementById('password-error').innerHTML = response.password;
        document.getElementById('password-con-error').innerHTML =
          response.passwordCon;
        if (response.focus != '') {
          document.getElementById(response.focus).focus();
        }
      }
    }
  };
}

function login() {
  document.getElementById('submit').disabled = true;
  const formElement = document.querySelectorAll('.form-data');
  const formData = new FormData();
  for (let i = 0; i < formElement.length; i++) {
    formData.append(formElement[i].name, formElement[i].value);
  }
  // console.log([...formData]);

  const ajaxRequest = new XMLHttpRequest();
  ajaxRequest.open('POST', 'process-data.php');
  ajaxRequest.send(formData);

  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState === 4 && ajaxRequest.status === 200) {
      document.getElementById('submit').disabled = false;

      const response = JSON.parse(ajaxRequest.responseText);

      if (response.success) {
        window.location.href = 'index.php';
      } else if (response.wrongCredentials) {
        document.getElementById('message').innerHTML =
          response.wrongCredentials;
        setTimeout(() => {
          document.getElementById('message').innerHTML = '';
        }, 2000);
        document.getElementById('name-error').innerHTML = '';
        document.getElementById('password-error').innerHTML = '';
        document.getElementById('username').focus();
      } else {
        // display validation error
        document.getElementById('name-error').innerHTML = response.username;
        document.getElementById('password-error').innerHTML = response.password;
        response.passwordCon;
        if (response.focus != '') {
          document.getElementById(response.focus).focus();
        }
      }
    }
  };
}

function updateProfile() {
  document.getElementById('submit').disabled = true;
  const formElement = document.querySelectorAll('.form-data');
  const formData = new FormData();
  for (let i = 0; i < formElement.length; i++) {
    formData.append(formElement[i].name, formElement[i].value);
  }
  // send file to server
  const image = document.getElementById('image');
  formData.append(image.name, image.files[0]);
  const oldImage = document.getElementById('oldImage');
  formData.append('oldImage', oldImage.alt);
  // console.log([...formData]);

  let req = new Request('process-data.php', {
    method: 'POST',
    body: formData,
  });

  // fetch(req)
  //   .then((response) => response.text())
  //   .then((data) => {
  //     document.getElementById('submit').disabled = false;
  //     console.log(data);
  //   });

  fetch(req)
    .then((response) => {
      document.getElementById('submit').disabled = false;
      return response.json();
    })
    .then((data) => {
      if (data.success) {
        // document.getElementById('message').innerHTML = data.success;
        // setTimeout(() => {
        //   document.getElementById('message').innerHTML = '';
        // }, 2000);
        // document.getElementById('name-error').innerHTML = '';
        // document.getElementById('email-error').innerHTML = '';
        // document.getElementById('password-error').innerHTML = '';
        // document.getElementById('password-con-error').innerHTML = '';
        // document.getElementById('password').value = '';
        // document.getElementById('password-con').value = '';
        window.location.href = 'profile.php';
      } else {
        // display validation error
        document.getElementById('name-error').innerHTML = data.username;
        document.getElementById('email-error').innerHTML = data.email;
        document.getElementById('image-error').innerHTML = data.image;
        document.getElementById('password-error').innerHTML = data.password;
        document.getElementById('password-con-error').innerHTML =
          data.passwordCon;
        if (data.focus != '') {
          document.getElementById(data.focus).focus();
        }
      }
    });
}
