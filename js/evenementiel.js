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

                            $("a.supprimer_ligne").click(function(e) {
                                e.preventDefault();
                                theHREF = $(this).attr("href");
                                $("#dialog-confirm_admin").dialog("open");
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
        $(document).ready(function() {

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
                header: {
                        center: '',
                        left: 'title',
                        right: 'prev,next month,basicWeek,basicDay'
                },
                editable: false,

                events: [
                        {
                                title: 'Rendez vous avec Mr Lepetit\nAutomobile',
                                start: new Date(y, m, 1)


                        },
                        {
                                title: 'Long Event',
                                start: new Date(y, m, d-5),
                                end: new Date(y, m, d-2)
                        },
                        {
                                id: 999,
                                title: 'Repeating Event',
                                start: new Date(y, m, d-3, 16, 0),
                                allDay: false
                        },
                        {
                                id: 999,
                                title: 'Repeating Event',
                                start: new Date(y, m, d+4, 16, 0),
                                allDay: false
                        },
                        {
                                title: 'Meeting',
                                start: new Date(y, m, d, 10, 30),
                                allDay: false
                        },
                        {
                                title: 'Lunch',
                                start: new Date(y, m, d, 12, 0),
                                end: new Date(y, m, d, 14, 0),
                                allDay: false
                        },
                        {
                                title: 'Birthday Party',
                                start: new Date(y, m, d+1, 19, 0),
                                end: new Date(y, m, d+1, 22, 30),
                                allDay: false
                        },
                        {
                                title: 'Click for Google',
                                start: new Date(y, m, 28),
                                end: new Date(y, m, 29),
                                url: 'http://google.com/'
                        }
                ]

        });

});		