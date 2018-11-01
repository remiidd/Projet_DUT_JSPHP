var text_post = document.getElementById('areapost');

text_post.addEventListener("input", function(e){
  document.getElementById('nb_caract').innerHTML = text_post.value.length;
  if(text_post.value.length > 500){
    document.getElementById('nb_caract_string').style.color = 'red';
    document.getElementById('inscriBout').disabled = true;
    document.getElementById('inscriBout').style.backgroundColor = 'grey';
  }
  if(text_post.value.length <= 500){
    document.getElementById('nb_caract_string').style.color = 'black';
    document.getElementById('inscriBout').disabled = false;
  }
});
