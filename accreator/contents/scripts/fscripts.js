/**********************************/
//  JS - GESTIONNAIRE FORMULAIRE  //
/**********************************/

function formvalider(form) {	

	var account = form.acc.value;
	var password = form.psw.value;
	var password2 = form.psw2.value;
	var email = form.email.value;
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");
	var result = document.getElementById('result');
	
	if(account.length < 4 || password.length < 4) {
		result.innerHTML = 'Inscription ivalide. Chaque champs doit avoir au moins 4 caractères !';
	}
	else if(!NotDetected(form.acc.value) || !NotDetected(form.psw.value)){
		result.innerHTML = 'Inscription ivalide. Les caractères spéciaux sont interdits !';
	} 
	else if(password != password2) {
		result.innerHTML = 'Le second mot de passe entré ne correspond pas au premier !';
	}
	else if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2>= email.length) /* CREDIT : w3schools.com */ {
		result.innerHTML = "L'email que vous avez entré n'est pas valide !";
	}
	else{
		form.action="contents/scripts/index.php";
		form.submit();
	}
}

function NotDetected(chaine) {
	var CaracteresInterdits = "\ \`\²\%\*\,\.\?\;\:\§\!\#\$\£\¤\(\)\~\/\\\'\=\+\{\}\[\]|^@&\"\"\<\>©®ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ";

	var i = 0;
	var Result = true;
	var fin = chaine.length;

	for (var i = 0; i<fin; i++) {
		var carac = chaine.substring(i, i + 1);
		if (CaracteresInterdits.indexOf(carac) != (-1)) {
			Result = false;
		}
	}
	if (Result==false) return false;
	else return true;
}