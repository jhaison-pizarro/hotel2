<script src="dist/plugins/calendar/moment.min.js"></script>
<script src="dist/plugins/calendar/fullcalendar.min.js"></script> 
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {
      var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'General',
        month: 'Mes',
        week: 'Semana',
        day: 'Dia'
      },
      
      events: [
          <?php foreach($habitaciones as $event): ?>
          <?php
            $fecha_entrada  = $event->entrada;
            $fecha_salida   = $event->salida;
            $dia_entrada    = intval(substr($fecha_entrada, 8, 2)); // Convertir a entero
            $dia_salida     = intval(substr($fecha_salida, 8, 2)); // Convertir a entero
            $mes_entrada    = intval(substr($fecha_entrada, 5, 2)); // Convertir a entero
            $mes_salida     = intval(substr($fecha_salida, 5, 2)); // Convertir a entero  
            
          ?>
          {
            title: ' Habitacion <?php echo $event->numero.' - '.$event->nombre.' '.$event->apellido; ?>',
            start: '2024,<?php echo $mes_entrada; ?> , <?php echo $dia_entrada; ?>',
            end:   '2024, <?php echo $mes_salida; ?>, <?php echo $dia_salida+1; ?>',
            backgroundColor: "#b30000", //Primary (light-blue)
            borderColor: "#b30000" //Primary (light-blue)
          },
        <?php endforeach; ?>
      
        <?php foreach($eventos as $events): ?>
          <?php
            $fecha_i = $events->fecha_i;
            $fecha_f = $events->fecha_f;
            $i = intval(substr($fecha_i, 8, 2)); // Convertir a entero
            $f = intval(substr($fecha_f, 8, 2)); // Convertir a entero
          ?>
          {
            title: '<?php echo $events->descripcion ; ?>',
            start: new Date(y, m, <?php echo $i; ?>),
            end:   new Date(y, m, <?php echo $f+1; ?>),
            backgroundColor: '<?php echo $events->color ; ?>',
            borderColor: '<?php echo $events->color ; ?>', //Primary (light-blue)
          },
        <?php endforeach; ?>
      ],


      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

       
        


      }
    });

    /* ADDING EVENTS */
   
    var colorChooser = $("#color-chooser-btn");
    
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      $('#add-new-event').val(currColor);
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
     var val  = $("#new-event").val();
         color= $(this).val();
         
     fecha_i = $('#fecha_i').val();
     fecha_f  =$('#fecha_f').val();

     
      if (val.length == 0 || fecha_i == '' || fecha_f == '') {
        toast_msg('Agregue todos los datos', 'Peligro', 'warning');
        ("#new-event").focus();
        return;
      }
      $.ajax({

            url    : "{{ route('calendario.save_event') }}",  
            method : "POST",
            data   : { val : val, color: color, fecha_i:fecha_i, fecha_f:fecha_f, '_token'    : "{{ csrf_token() }}", },
            success: function(r) {

              if(!r.status)
              {
                toast_msg('Intente nuevamente', 'Peligro', 'error');
                return;
              }
              toast_msg('Eevnto registrado', 'Bien', 'success');
              var event = $("<div />");
              event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
              event.html(val);
              $('#external-events').prepend(event);
              ini_events(event);
              $("#new-event").val('');
              setTimeout(function(){
              window.location.href = "{{ url('calendario') }}"; 
              }, 200); 
              return;

            },
            dataType : "json"
      })
     
     
    });
  });

  $(document).ready(function() {
  $('#drop-remove').change(function() {
    if ($(this).is(':checked')) {
      // Checkbox marcado, obtener ID del elemento seleccionado
      var id = $('.eventos.selected').data('id');
      if(id == undefined)
      {
        toast_msg('Ningun Evento marcado', 'Peligro', 'error');
        return;
      }
      $.ajax({

        url    : "{{ route('calendario.remove_event') }}",  
        method : "POST",
        data   : { id : id,  '_token'    : "{{ csrf_token() }}", },
        success: function(r) {
          if(!r.status)
          {
            toast_msg('Intente nuevamente', 'Peligro', 'error');
            return;
          }
          toast_msg('Eevnto eliminado', 'Bien','success');
          $('.eventos.selected').remove();
          setTimeout(function(){
              window.location.href = "{{ url('calendario') }}"; 
              }, 200); 
              return;
        },
        dataType : "json"
      })
    }
    
  });

  $('.eventos').click(function() {
    
      $(this).toggleClass('selected');
  });
});
  
</script>