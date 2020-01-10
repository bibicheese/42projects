function display_big(img) {
  document.getElementById("big_img").src = img;
  document.getElementById("all2").style.display = "block";
}

function add_like(i) {
  $.ajax({
    method: 'POST',
    url: '/camagru/php/like_ajax.php',
    data: 'like=' + i,
    success: function(yes) {
      console.log("success");
    }
  });
  name = '#like' + i;
  name2 = '#thumb' + i;
  name3 = '#nb_like' + i;
  var elm = document.querySelector(name);
  var thumb = document.querySelector(name2);
  var tab = document.querySelector(name3).innerHTML.split(" ");
  var like = tab[0];
  if (elm.className == 'like blue')
  {
    elm.classList.remove("blue");
    thumb.classList.remove("blue");
    like--;
  }
  else
  {
    elm.classList.add("blue");
    thumb.classList.add("blue");
    like++;
  }
  var tab = document.querySelector(name3).innerHTML.split(" ");
  document.querySelector(name3).innerHTML = like + ' j\'aime';
}
