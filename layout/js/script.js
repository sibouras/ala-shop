function saveData() {
  const formElement = document.querySelectorAll('.form-data');
  const formData = new FormData();
  for (let i = 0; i < formElement.length; i++) {
    formData.append(formElement[i].name, formElement[i].value);
  }
  // console.log([...formData]);
  document.getElementById('submit').disabled = true;

  const ajaxRequest = new XMLHttpRequest();
  ajaxRequest.open('POST', 'process-data.php');
  ajaxRequest.send(formData);

  ajaxRequest.onreadystatechange = function () {
    if (ajaxRequest.readyState === 4 && ajaxRequest.status === 200) {
      document.getElementById('submit').disabled = false;

      const response = JSON.parse(ajaxRequest.responseText);
      console.log(response);

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
