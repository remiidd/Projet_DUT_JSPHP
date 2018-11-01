var text_post = document.getElementById('areapost');

text_post.addEventListener("input", function(e){
  document.getElementById('nb_caract').innerHTML = text_post.value.length;
  if(text_post.value.length > 500){
    document.getElementById('nb_caract_string').style.color = 'red';
  }
  if(text_post.value.length <= 500){
    document.getElementById('nb_caract_string').style.color = 'black';
  }
});
