$(document).ready(function(){
	$('#filiere').show(1000);
	$('#info').show(1500);
	$('#mmi').show(1500);
	$('#geii').show(1500);
	$('etudiants').hide();
	
	/*Lorsqu'on a choisit une filiere*/
	$('#filiere').change(function(){
		$('#promotion').show(1000);
		$('#info1').show(1000);
		$('#info2').show(1800);
		affichage_tableau();
	})

	/*Lorsqu'on clique sur une promotion*/
	$('#promotion').change(function(){
		$('#groupe').show();
		$('#groupeCM').show(1000);
		$('#groupeTD').show(1400);
		$('#groupeTP').hide();
		affichageGroupeTP();
		affichage_tableau();
	})

	/*teste sur les promotions*/
	$('#groupeCM').on('change', function(){
		affichageGroupeTP();
		affichage_tableau();
	});
	
	$('#groupeTD').on('change', function(){
		affichageGroupeTP();
		affichage_tableau();
	})
	$('#groupeTP').on('change', function(){
		affichage_tableau();
	})

	$('#matiere').change(function(){
		$('#prof').show(500);
		$('#professeurs').empty();
		var nom = $('#matiere option:selected').text();
		var id = $('#matiere option:selected').val();
		
		/*Requete ajax*/
        $.ajax({
        	url: 'app/professeurs.php', /*le script qui traite la requete*/
        	type: 'post',
        	data:{
        		idmat: id,
        	},

        	dataType:'json',
        	
        	/*fonction de retour (succes)*/
        	success: function(json){
        		/*pour chaque couple du json on le met dans le select*/
        		$.each(json, function(ensid, ensnom){
        			$('#professeurs').append("<option value="+ensid+">"+ensnom+"</option>");
        		});
        		$('#eval').show('slow');
				$('#calendrier').show('slow');
        	}
    	})
	})

	/*lorsqu'on selectionne une nouvelle date dans le datepickers*/
	$('#calendrier').change(function(){
		$('#horaire').show('slow');
		$('#calendrier input').val( $('#datepicker').val() );  /*place dans le champ caché la valeur du datepicker*/
		affichage_absent();
	})
	
	$('#horaire').change(function(){
		/*tableau contenant les horaires selectionnés*/
		var horaires = [];
		$('#horaires option:selected').each(function(index){ /*recupere la selection multiple de mes horaires*/
			horaires[index] = $(this).val(); 
		})
		$('#valider').show('slow');
	})
	
	$('#valider').on('click', function(){
		validationFormulaire();
	})
	
})

/*pour afficher correctement les radio groupeTP*/
function affichageGroupeTP(){
	$('#groupeTP').hide();
	
	if( $('#groupeTD :checked').val() == 1){ /*affiche le tp1 et tp2*/
		$('#groupeTP').show(500);
		$('#groupeTP label').slice(0,2).show();
		$('#groupeTP label').slice(2,4).hide();
	}
	else{ 									/*affiche le tp3 et tp4*/
		$('#groupeTP').show(500);
		$('#groupeTP label').slice(2,4).show();
		$('#groupeTP label').slice(0,2).hide();	
	}
}
function affichage_tableau(){
	affichage_etudiant();
	affichage_absent();
}

/*affiche la liste des etudiant de la filiere, de la promo et du groupe selectionne*/
function affichage_etudiant(){
	var filiere = $('#filiere :checked').val();
	var promo = $('#promotion :checked').val();
	var groupeCM = $('#groupe :checked').val();
	var groupeTD = $('#groupeTD :checked').val();
	var groupeTP = $('#groupeTP :checked').val();

	/*test si tout est selectionné*/
	if( $('input[name=groupeCM]').is(':checked') && $('input[name=groupeTD]').is(':checked') && $('input[name=groupeTP]').is(':checked')){
		$('#fonctionnalites').hide();
		$('#matiere-prof').show('slow');
		$('#matiere').show('slow');
		$('#prof').hide();
		$('#eval').hide();

		/*Pour l'affichage des etudiants du groupe*/
		$.ajax({
			url: './app/liste_etudiants.php', /*le script qui traite la requete*/
			type: 'post',
			data:{
				filiere: filiere,
				promo: promo,
				groupeCM: groupeCM,
				groupeTD: groupeTD,
				groupeTP: groupeTP,
			},

			dataType:'json',
			
			/*fonction de retour (succes)*/
			success: function(json){
				$('#table_etudiant').hide();
				$('#table_etudiant').empty(); /*on vide la table si on a une nouvelle requete*/
				$('#table_etudiant').append("<caption>Etudiants de la promotion:"+ filiere + promo + "<br/>TD:" + groupeTD + "<br/>TP:" + groupeTP + "<br/><b><u>Sélectionnez les etudiants absents ou en retard</b><u/></caption><thead><tr><th>id étudiant</th><th>etudiant</th><th>retards</th><th>absences</th></tr></thead><tbody>");
				
				$.each(json, function(etuid, etudiant){
					/*ajout du tableau et des absents*/
					$('#table_etudiant').append(
						'<tr>'+
							'<td>' + etuid + '</td>'+
							'<td>' + etudiant + '</td>'+
							'<td><input type=checkbox class=retard name=retard[] value='+etuid+'></input></td>'+
							'<td><input type=checkbox class=absence name=absence[] value='+etuid+'></input></td>'+	
						'</tr>'
					);
				})
				$('#table_etudiant').append('</tbody>');
				$('#etudiants').show(1000);
				$('#table_etudiant').show(1000);
			}
		})
	}
}

/*fonction qui affiche le tableau avec les eleves deja absent le jour selectionne dans le datepicker*/
function affichage_absent(){
	$('#table_absent').empty();      /*on vide la table a chaque nouvelle date*/
	var filiere = $('#filiere :checked').val();
	var promo = $('#promotion :checked').val();
	var date = $('#datepicker').val();
	var groupeTD = $('#groupeTD :checked').val();
	var groupeTP = $('#groupeTP :checked').val();
	
	/*si une date est selectionné*/
	if( $('#calendrier input').val() != "" ){
		/*Requete ajax*/
	    $.ajax({
	    	url: 'app/liste_absents.php',
	    	type: 'post',
	    	data:{
	    		date: date,
	    		filiere: filiere,
				promo: promo,
				groupeTD: groupeTD,
				groupeTP: groupeTP,
	    	},

	    	dataType:'json',
	    	success: function(json){
	    		$('#table_absent').hide();
				$('#table_absent').empty(); /*on vide la table si on a une nouvelle requete*/
	    		$('#table_absent').append("<caption><b>Absences du " + date + "<br/>Promotion:"+ filiere + promo + "<br/>TD:" + groupeTD + "<br/>TP:" + groupeTP + "</b></caption><thead><tr><th>horaires</th><th>étudiant</th></tr></thead><tbody>");
	    		
	    		/*ajout du tableau et des absents*/
	    		$.each(json, function(horaire, etudiants){
					$('#table_absent').append(
						'<tr>'+
							'<td>' + horaire + '</td>'+
							'<td>' + etudiants + '</td>'+
						'</tr>'
					);
	       		})
	       		$('#table_absent').append('</tbody>');
	       		$('#absents').show(1000);
	       		$('#table_absent').show(1000);
	    	}
		})
	}
}

/*permet de valider le formulaire*/
function validationFormulaire(){
	
	var resultat = confirm('êtes-vous sur de vouloir enregistrer ces absences et ces retards ?');	
	/*Si ok alors on le supprime*/
	if (resultat == true){
		$('#formulaire').submit();
	}
	else{
		alert("Vous n'avez rien enregistrer");
	}
}