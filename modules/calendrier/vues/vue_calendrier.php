<script type="text/javascript">
   
var lignes_tab = <?php echo json_encode($lignes_tableau) ?>;
var event = []

for (var i = 0; i < lignes_tab.lenght; i++){
    var new_dict = {
        title: 'oui oui',
        start: new Date(
            lignes_tab['date'].substring(0, 2),
            lignes_tab['date'].substring(3, 2),
            lignes_tab['date'].substring(6, 2)),
    }
    event[i] = new_dict;
}

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

                events: event
                        
               /*[
                        {
                                title: 'loliklol',
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
                        }
                ]*/
        });
});	
</script>
<div id='calendar'>  
</div>