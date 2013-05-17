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
                        //Confirmation suppression site web
                        $(".td_gestion").click(function() {
                                var element = $(this).parent(); 
                                $( "#dialog-confirm" ).dialog({
                                  resizable: false,
                                  height:200,
                                  width : 500,
                                  modal: true,
                                  buttons: {
                                        "Oui": function() {

                                          $( this ).dialog( "close" );
                                          $(element).remove();
                                        },
                                        "Non": function() {
                                          $( this ).dialog( "close" );
                                        }
                                  }
                                });
                            });
                            //Confiramtion duppression ligne tableau administration
                            var theHREF;
                            $( "#dialog-confirm_admin" ).dialog({
                                
                                resizable: false,
                                height:200,
                                width:500,
                                autoOpen: false,
                                modal: true,
                                buttons: {
                                    "Oui": function() {
                                        $( this ).dialog( "close" );
                                        window.location.href = theHREF;
                                    },
                                    "Annuler": function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            }); 
                            var theHREF;
                            $( "#dialog-confirm-fichier" ).dialog({
                                
                                resizable: false,
                                height:200,
                                width:500,
                                autoOpen: false,
                                modal: true,
                                buttons: {
                                    "Oui": function() {
                                        $( this ).dialog( "close" );
                                        window.location.href = theHREF;
                                    },
                                    "Annuler": function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });
                            $( "#dialog-confirm_dossier" ).dialog({
                                
                                resizable: false,
                                height:200,
                                width:500,
                                autoOpen: false,
                                modal: true,
                                buttons: {
                                    "Continuer": function() {
                                        $( this ).dialog( "close" );
                                        window.location.href = theHREF;
                                    },
                                    "Annuler": function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            }); 
                            $("a.supprimer_ligne").click(function(e) {
                                e.preventDefault();
                                theHREF = $(this).attr("href");
                                $("#dialog-confirm_admin").dialog("open");
                            });
                            $("a#menu_creer_dossier").click(function(e) {
                                e.preventDefault();
                                theHREF = $(this).attr("href");
                                $("#dialog-confirm_dossier").dialog("open");
                            });
                            
                            /**********************************************
                             * Dialog message de suppression/creation/maj
                             * 
                             */
                            
                            $( ".dialog_admin" ).dialog({
                                modal: true,
                                buttons: {
                                  Ok: function() {
                                    $( this ).dialog( "close" );
                                  }
                                }
                              });
                            $( "#dialog_dossier_cree" ).dialog({
                                modal: true,
                                buttons: {
                                  Ok: function() {
                                    $( this ).dialog( "close" );
                                  }
                                }
                              });
                              $( "#dialog_maj_event" ).dialog({
                                modal: true,
                                autoOpen: false,
                                buttons: {
                                  Ok: function() {
                                    $( this ).dialog( "close" );
                                  }
                                }
                              });
                            
                              
                            
                           
});

      
jQuery(function($){
                $.datepicker.regional['fr'] = {
                        closeText: 'Fermer',
                        prevText: 'Pr&eacute;c&eacute;dent',
                        nextText: 'Suivant',
                        currentText: 'Aujourd\'hui',
                        monthNames: ['Janvier','F&eacute;vrier','Mars','Avril','Mai','Juin',
                        'Juillet','Ao&ucirc;t','Septembre','Octobre','Novembre','D&eacute;cembre'],
                        monthNamesShort: ['Janv.','F&eacute;vr.','Mars','Avril','Mai','Juin',
                        'Juil.','Ao&ucirc;t','Sept.','Oct.','Nov.','D�c.'],
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
                $('textarea').elastic();



        });

        	