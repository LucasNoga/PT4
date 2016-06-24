$(document).ready(function(){
	modif_etudiants();
})

/**fonction pour la page modif_etudiants*/
function modif_etudiants(){
	$('#filiere').show(500);
	$('#info').show(1000);
	$('#mmi').show(1300);
	$('#geii').show(1600);

	/*Quand on change la filiere*/
	$('#filiere').on('change', function(){
		liste_etudiant();
    })
	
	/*Quand on change la promo*/
	$('#promo').on('change', function(){
		liste_etudiant();
    })
       
	/*lorsqu'on a selectioner un etudiant*/
	$('#etudiant').change(function(){
		$('#action').show(1000);
	})

	/*le lien de suppression*/
	$('#suppr').click(function(){
		var nom = $('#etudiant option:selected').text();
		var id = $('#etudiant option:selected').val();
		var resultat = confirm('etes vous sur de vouloir supprimer '+ nom + '?');
		
		/*Si ok alors on le supprime*/
		if (resultat == true){
			/*Requete ajax*/
	        $.ajax({
	        	url:'supprimer_etudiant.php', /*le script qui traite la requete*/
	        	type: 'post',
	        	data:{
	        		
	        		etudiant: nom,
	        		etuid: id,
	        	},
	        	
	        	/*fonction de retour (succes)*/
	        	success: function(){
	        		alert('etudiant supprimer');
	        		location.reload();
	        	}
	    	});
	    }
	})

	$('#modif').click(function(){
		alert('cette fonctionnalite n\'est pas disponible');
	})
}

/*fonction qui recupere tous les etudinats de la promo*/
function liste_etudiant(){
	$('#promo').show(500);
	$('#champ1').show(1000);
	$('#champ2').show(1400);

	var filiere = $('input[name=filiere]:checked').val();
    var promo = $('input[name=promo]:checked').val(); /*recupere la valeur de la radio selectionne*/
   

    if(promo == '1' || promo == '2' ){
        /*Requete ajax*/
        $.ajax({
        	url:'liste_etudiant.php', /*le script qui traite la requette*/
        	type: 'post', /*methode de la requete*/

        	/*les donnees fournis au script php avec $_POST*/ 
        	data:{
        		
        		filiere: filiere,
        		promo: promo,
        	},
        	
        	dataType: 'json', /*le type de retour (text, html, json) dans notre cas juste la filiere et la promo*/
        	
        	/*on affiche le select avec les etudiants*/
        	success: function(json){	
        		$('#monSelect').show();
        		$('#etudiant').css('width', '35em');
        		$('#etudiant').hide();
        		$('#etudiant').show(250);
        		$('#etudiant').empty();
        		 
        		/*ajout des etudiants*/
        		$.each(json, function(etuid, nom){
        			$('#etudiant').append("<option value="+etuid+">"+nom+"</option>");
        		})
        		/*recupere le nombre d'option*/
        		var opt = $('#etudiant option').size();
        		$('#etudiant').attr('size',opt);
        	}
        })
    }
}