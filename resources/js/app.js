import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const rawEvents = calendarEl.getAttribute('data-events');
    const eventData = JSON.parse(rawEvents || '[]');

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        height: 'auto',
        handleWindowResize: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth'
        },
        events: eventData,
        editable: true,
        eventDrop: function(info) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/content-ideas/${info.event.id}/update-date`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    tanggal: info.event.startStr
                })
            }).then(res => {
                if(!res.ok) info.revert();
            }).catch(() => info.revert());
        }
    });

    setTimeout(() => {
        calendar.render();
    }, 100);
});
