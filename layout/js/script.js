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
      document.getElementById('register-form').reset();
      document.getElementById('message').innerHTML = ajaxRequest.responseText;
      setTimeout(() => {
        document.getElementById('message').innerHTML = '';
      }, 2000);
    }
  };
}
