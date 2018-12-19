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

function liker_post(id_posts) {
  var xhr = getXMLHttpRequest();
  var id_post = encodeURIComponent(id_posts);
  try {
    xhr.open("GET", "scripts/php/like.php?id_post="+id_post,true);
    xhr.send(null);
  }catch(error) {
    alert(error);
  }
}

$(".bouton_like").click(function(){
	var id_post = this.getAttribute('id');
	id_post = encodeURIComponent(id_post);
	var xhr = getXMLHttpRequest();

  try {
    xhr.open("GET", "scripts/php/like.php?id_post="+id_post,true);
    xhr.send(null);
  }catch(error) {
    alert(error);
  }

	xhr.responseType = 'document';
	xhr.overrideMimeType('text/html');

		xhr.onload = function() {
			if (xhr.readyState === xhr.DONE) {
				if (xhr.status === 200) {
					console.log(xhr.responseXML);
				}
			}
		};

});

function share_post(id_posts, id_profils) {
	var xhr = getXMLHttpRequest();

	var id_post = encodeURIComponent(id_posts);
  var id_profil = encodeURIComponent(id_profils);
	try {
    xhr.open("GET", "scripts/php/share.php?id_post="+id_post+"&id_profil="+id_profil,true);
    xhr.send(null);
  }catch(error) {
    alert(error);
  }
}

function suppr_emploi(id,element) {
  var xhr = getXMLHttpRequest();

  var id = encodeURIComponent(id);
  try {
    xhr.open("GET", "scripts/php/suppr_emploi.php?id="+id,true);
    xhr.send(null);
  }catch(error) {
    alert(error);
  }
	element.parentNode.parentNode.removeChild(element.parentNode);
}

function suppr_etude(id,element) {
  var xhr = getXMLHttpRequest();

  var id = encodeURIComponent(id);
  try {
    xhr.open("GET", "scripts/php/suppr_etude.php?id="+id,true);
    xhr.send(null);
  }catch(error) {
    alert(error);
  }
	element.parentNode.parentNode.removeChild(element.parentNode);
}
