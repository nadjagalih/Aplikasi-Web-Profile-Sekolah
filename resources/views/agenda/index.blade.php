@extends('layouts.main')

@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <h2>Agenda Kegiatan</h2>
      <ol>
        <li><a href="/">Beranda</a></li>
        <li>Agenda</li>
      </ol>
    </div>
  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Agenda Section ======= -->
<section id="agenda" class="agenda section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Kalender Agenda Kegiatan Puskesmas</h2>
      <p>Lihat jadwal kegiatan dan acara yang akan dilaksanakan di Puskesmas</p>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal untuk detail agenda -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eventModalLabel">Detail Agenda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h4 id="modalTitle"></h4>
            <p><strong><i class="bi bi-calendar-event me-2"></i>Waktu:</strong></p>
            <p id="modalDate" class="ms-4"></p>
            <div id="modalLocation"></div>
            <div id="modalDescription"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</section><!-- End Agenda Section -->

<style>
  .agenda {
    padding: 60px 0;
    background-color: #f8f9fa;
  }

  #calendar {
    max-width: 100%;
    margin: 0 auto;
  }

  .fc .fc-button-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
  }

  .fc .fc-button-primary:hover {
    background-color: #0b5ed7;
    border-color: #0b5ed7;
  }

  .fc .fc-button-primary:not(:disabled):active,
  .fc .fc-button-primary:not(:disabled).fc-button-active {
    background-color: #0a58ca;
    border-color: #0a58ca;
  }
</style>

<!-- FullCalendar CSS & JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/locales/id.global.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'id',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,listMonth'
    },
    buttonText: {
      today: 'Hari Ini',
      month: 'Bulan',
      week: 'Minggu',
      list: 'Daftar'
    },
    events: '/agenda/events',
    eventClick: function(info) {
      // Format tanggal
      const start = new Date(info.event.start);
      const end = info.event.end ? new Date(info.event.end) : null;
      
      const formatDate = (date) => {
        return date.toLocaleDateString('id-ID', {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric',
          hour: '2-digit',
          minute: '2-digit'
        });
      };
      
      let dateStr = formatDate(start);
      if (end && end.getTime() !== start.getTime()) {
        dateStr += ' - ' + formatDate(end);
      }
      
      // Isi modal
      document.getElementById('modalTitle').textContent = info.event.title;
      document.getElementById('modalDate').textContent = dateStr;
      
      // Location
      if (info.event.extendedProps.location) {
        document.getElementById('modalLocation').innerHTML = 
          '<p><strong><i class="bi bi-geo-alt me-2"></i>Tempat:</strong></p>' +
          '<p class="ms-4">' + info.event.extendedProps.location + '</p>';
      } else {
        document.getElementById('modalLocation').innerHTML = '';
      }
      
      // Description
      if (info.event.extendedProps.description) {
        document.getElementById('modalDescription').innerHTML = 
          '<p><strong><i class="bi bi-file-text me-2"></i>Deskripsi:</strong></p>' +
          '<p class="ms-4">' + info.event.extendedProps.description + '</p>';
      } else {
        document.getElementById('modalDescription').innerHTML = '';
      }
      
      // Show modal
      var myModal = new bootstrap.Modal(document.getElementById('eventModal'));
      myModal.show();
      
      info.jsEvent.preventDefault();
    },
    eventMouseEnter: function(info) {
      info.el.style.cursor = 'pointer';
    }
  });
  
  calendar.render();
});
</script>

@endsection
