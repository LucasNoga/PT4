$(document).ready(function(){
	modif_professeur();

	/*le lien de suppression*/
	$('#suppr').click(function(){
		var nom = $('#enseignant option:selected').text();
		var id = $('#enseignant option:selected').val();
		var resultat = confirm('etes vous sur de vouloir supprimer '+ nom + '?');
		
		/*Si ok alors on le supprime*/
		if (resultat == true){
			/*Requete ajax*/
	        $.ajax({
	        	url:'supprimer_enseignant.php', /*le script qui traite la requete*/
	        	type: 'post', /*methode de la requete*/

	        	/*les donnees fournis au script php avec $_POST*/ 
	        	data:{
	        		
	        		enseignant: nom,
	        		ensid: id,
	        	},
	        	
	        	/*fonction de retour (succes)*/
	        	success: function(){
	        		alert('professeur supprimer');
	        		$('#monSelect').hide(1000);
	        		$('#enseignant').empty();
	        		modif_professeur();
	        	}
	    	});
	    }
	})
})

/**fonction pour la page modif_enseignants*/
function modif_professeur(){
	$('#monSelect').show(1000);

	/*Requete ajax qui recupere les professeur*/
	$.ajax({
    	url:'liste_enseignants.php', /*le script qui traite la requette*/
    	type: 'post', /*methode de la requete*/
    	
    	dataType: 'json', /*le type de retour (text, html, json) dans notre cas juste la filiere et la promo*/
    	
    	/*fonction de retour (succes)*/
    	success: function(json){
    		$('#monSelect').show(500); /*on affiche le select*/
    		
    		/*pour chaque couple du json on le met dans le select*/
    		$.each(json, function(ensid, nom){
    			$('#enseignant').append("<option value="+ensid+">"+nom+"</option>");
    		})
    		
    		/*recupere le nombre d'option*/
    		var opt = $('#enseignant option').size();
    		$('#enseignant').attr('size',opt);
    	}
    });
	
	/*Lorsqu'on selectionne un professeur*/
	$('#enseignant').change(function(){
		$("#action").show(1000);
    })


}