document.addEventListener('DOMContentLoaded', function() {

  var calendarEl = document.getElementById('calendar');
  
  var calendar = new FullCalendar.Calendar(calendarEl, {
    locale: 'ru',
    firstDay: '1',
    disableDragging: true,
    headerToolbar: {
      left: 'prev,next',
      center: 'title',
      // right: 'multiMonthYear,dayGridMonth,timeGridWeek'
      right: 'today'
    },
    initialView: 'dayGridMonth',
    editable: false,
    selectable: false,
    showNonCurrentDates: true,
    businessHours: true,
    eventTimeFormat: {
      hour: 'numeric',
      minute: '2-digit',
      meridiem: false,
    },
    eventSources: [
      {
        events: events
      }
    ]
  });

  var view = calendar.view;
  console.log(view.activeStart);
  console.log(view.activeEnd);

  calendar.render();
});