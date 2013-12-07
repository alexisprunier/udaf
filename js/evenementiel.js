$(document).ready( function () {
    
                        
 
                        
                        // GESTION DES EVENEMENTS DROITE DE CREATION DOSSIER
                        $(".comment_rdv").hide();
                        

                        

                        $(".click_event").click(function () {   				

                                var id = $(this).parent().attr("id");
                                if(id=="deplier")
                                        $(this).parent().attr("id", "deplier_ok");
                                else $(this).parent().attr("id", "deplier");
                                $(this).parent().parent().next("tr.cacher").find("textarea").slideToggle("fast"); 
                                return false;

                        }); 

                        $('.scroll_tab').fixedHeaderTable({  autoShow: true

                        });
                        
                            
                        
                            
                            
                            
                              
                            
                              
                            
                           
});

      
jQuery(function($){
                $.datepicker.regional['fr'] = {
                        closeText: 'Fermer',
                        prevText: 'Précédent',
                        nextText: 'Suivant',
                        currentText: 'Aujourd\'hui',
                        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
                        'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
                        monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin',
                        'Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
                        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
                        dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
                        dayNamesMin: ['D','L','M','M','J','V','S'],
                        weekHeader: 'Sem.',
                        dateFormat: 'dd/mm/yy',
                        firstDay: 1,
                        isRTL: false,
                        showMonthAfterYear: false,
                        yearSuffix: ''};
                        $.datepicker.setDefaults($.datepicker.regional['fr']);
        });

        $(function() {
                $( ".datepicker" ).datepicker({
                        showOtherMonths: true,
                        selectOtherMonths: true
                        });
                $('textarea.comment, textarea.comment_cloture').elastic();



        });

        	