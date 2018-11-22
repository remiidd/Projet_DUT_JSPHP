function getXMLHttpRequest() {
	var xhr = null;

	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest();
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest");
		return null;
	}

	return xhr;
}

function liker_post(id_posts, id_profils) {
  var xhr = getXMLHttpRequest();

  var id_post = encodeURIComponent(id_posts);
  var id_profil = encodeURIComponent(id_profils);
  console.log("salut");
  try {
    xhr.open("GET", "scripts/php/like.php?id_post="+id_post+"&id_profil="+id_profil,true);
    xhr.send(null);
  }catch(error) {
    alert(error);
  }
}

function modif_email(id_profils, email) {
  var xhr = getXMLHttpRequest();

	var id_req = 0;
  var email = encodeURIComponent(email);
  var id_profil = encodeURIComponent(id_profils);
  console.log("salut");
  try {
    xhr.open("GET", "scripts/php/req.php?id_req="+id_req+"&email="+email+"&id_profil="+id_profil,true);
    xhr.send(null);
  }catch(error) {
    alert(error);
  }
}
