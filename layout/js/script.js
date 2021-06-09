function menuToggle() {
  const toggleMenu = document.querySelector('#user-dropdown .menu');
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
