$(document).ready(function(){
	modif_modules();

    $('#suppr').click(function(){
        var module = $('#modules option:selected').text();
        var code = $('#modules option:selected').val();
        var resultat = confirm('etes vous sur de vouloir supprimer le module \"'+ module + '\" ?');
        
        /*Si ok alors on le supprime*/
        if (resultat == true){
            /*Requete ajax*/
            $.ajax({
                url:'supprimer_modules.php', /*le script qui traite la requete*/
                type: 'post', /*methode de la requete*/

                /*les donnees fournis au script php avec $_POST*/ 
                data:{
                    
                    module: module,
                    mcodeppn: id,
                },
                
                /*fonction de retour (succes)*/
                success: function(){
                    alert('module supprimé');
                    $('#monSelect').hide(1000);
                    $('#modules').empty();
                    modif_modules();
                }
            });
        }
    })
})

/**fonction pour la page modif_module*/
function modif_modules(){
	$('#monSelect').show(1000);

	/*Requete ajax qui recupere les modules*/
	$.ajax({
    	url:'liste_modules.php', /*le script qui traite la requete*/
    	type: 'post', /*methode de la requete*/
    	
    	dataType: 'json', /*le type de retour (text, html, json) dans notre cas juste la filiere et la promo*/
    	
    	/*fonction de retour (succes)*/
    	success: function(json){
    		$('#monSelect').show(500); /*on affiche le select*/
    		
    		/*pour chaque couple du json on le met dans le select*/
    		$.each(json, function(mcodeppn, mnom){
    			$('#modules').append("<option value="+mcodeppn+">"+mnom+"</option>");
    		})
            var opt = $('#modules option').size();
            $('#modules').attr('size', opt);
    	}
    })

    /*Lorsqu'on selectionne un professeur*/
    $('#modules').change(function(){
        $("#action").show(1000);
    })
}