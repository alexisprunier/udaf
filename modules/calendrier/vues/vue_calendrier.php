<script type="text/javascript">
$(document).ready(function() { 
    
        $('#calendar').fullCalendar({
                header: {
                        center: '',
                        left: 'title',
                        right: 'prev,next month,basicWeek,basicDay'
                },
                editable: false,
                events: <?php feed(); ?>
        });
});	
</script>
<div id='calendar'>  
</div>

<?php
function feed(){
    $tab_evenement = lister_evenement_dans_bdd();

    $lignes_tableau = array();

    foreach ($tab_evenement as &$evenement){
        $dossier = selectionner_dossier_dans_bdd($evenement->dossier_id);
        $personne = selectionner_personne_dans_bdd($dossier['personne_id']);
        $utilisateur = selectionner_utilisateur_dans_bdd($evenement->user_id);

        $ligne = array(
            'title' => 'Contact de '.$utilisateur['ident'].' avec '.$personne['nom'].' '.$personne['prenom'].' par '.$evenement->mode_contact,
            'start' => substr($evenement->date_event, 6, 4)."-".substr($evenement->date_event, 3, 2)."-".substr($evenement->date_event, 0, 2)."T00:00:00Z",
            'end' => substr($evenement->date_event, 6, 4)."-".substr($evenement->date_event, 3, 2)."-".substr($evenement->date_event, 0, 2)."T00:00:00Z",
            'allDay' => false
        );

        array_push($lignes_tableau, $ligne);
    }
    echo json_encode($lignes_tableau);
}
?>