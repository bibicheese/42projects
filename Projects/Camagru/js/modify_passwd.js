var element = document.getElementsByClassName('passwd_modify');

function show_passwd_modify() {
  if (element[0].style.display == 'block') {
    element[0].style.display = 'none';
  }
  else
    element[0].style.display = 'block';
}
