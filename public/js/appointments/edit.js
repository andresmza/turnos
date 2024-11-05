// document.addEventListener('DOMContentLoaded', function() {
//     const specialtySelect = document.getElementById('specialty_id');
//     const doctorSelect = document.getElementById('doctor_id');
//     const appointmentDateSelect = document.getElementById('appointment_date');
//     const availableSchedulesSelect = document.getElementById('available_schedules');

//     // Obtener el horario actual de la cita
//     const currentAppointmentTime = availableSchedulesSelect.getAttribute('data-current-time');

//     // Función para limpiar las opciones de un <select> si hay un cambio en el selector
//     function clearSelect(selectElement) {
//         selectElement.innerHTML = '<option value="">Seleccionar</option>';
//     }

//     // Función para cargar los doctores de la especialidad seleccionada
//     function loadDoctors() {
//         const specialtyId = specialtySelect.value;
//         if (!specialtyId) return; // No hacer nada si no hay una especialidad seleccionada

//         clearSelect(doctorSelect); // Limpia solo al hacer cambios
//         clearSelect(appointmentDateSelect);
//         clearSelect(availableSchedulesSelect);

//         fetch(`/doctors/by-specialty/${specialtyId}`)
//             .then(response => response.json())
//             .then(doctors => {
//                 doctors.forEach(doctor => {
//                     const option = document.createElement('option');
//                     option.value = doctor.id;
//                     option.text = `${doctor.person.first_name} ${doctor.person.last_name}`;
//                     doctorSelect.appendChild(option);
//                 });
//             })
//             .catch(error => console.error('Error al obtener los doctores:', error));
//     }

//     // Función para cargar las fechas disponibles para el doctor seleccionado
//     function loadAvailableDates() {
//         const doctorId = doctorSelect.value;
//         if (!doctorId) return; // No hacer nada si no hay un doctor seleccionado

//         clearSelect(appointmentDateSelect);
//         clearSelect(availableSchedulesSelect);

//         fetch(`/doctors/${doctorId}/available-days`)
//             .then(response => response.json())
//             .then(dates => {
//                 dates.forEach(dateString => {
//                     const option = document.createElement('option');
//                     option.value = dateString;
//                     option.text = dateString.split('-').reverse().join('-'); // Mostrar como DD-MM-YYYY
//                     appointmentDateSelect.appendChild(option);
//                 });
//             })
//             .catch(error => console.error('Error al obtener las fechas disponibles:', error));
//     }

//     // Función para cargar los horarios disponibles para la fecha y el doctor seleccionados
//     function loadAvailableSchedules() {
//         const doctorId = doctorSelect.value;
//         const selectedDate = appointmentDateSelect.value;
//         if (!doctorId || !selectedDate) return; // No hacer nada si no hay doctor o fecha seleccionada

//         clearSelect(availableSchedulesSelect);

//         fetch(`/doctors/${doctorId}/available-schedules?date=${selectedDate}`)
//             .then(response => response.json())
//             .then(slots => {
//                 let currentTimeIncluded = false;

//                 slots.forEach(slot => {
//                     const option = document.createElement('option');
//                     option.value = slot.time;
//                     option.text = slot.time;

//                     // Selecciona el horario actual si está en la lista
//                     if (slot.time === currentAppointmentTime) {
//                         option.selected = true;
//                         currentTimeIncluded = true;
//                     }
//                     availableSchedulesSelect.appendChild(option);
//                 });

//                 // Agregar la hora actual si no está en los horarios disponibles
//                 if (currentAppointmentTime && !currentTimeIncluded) {
//                     const option = document.createElement('option');
//                     option.value = currentAppointmentTime;
//                     option.text = `${currentAppointmentTime} (Actual)`;
//                     option.selected = true;
//                     availableSchedulesSelect.appendChild(option);
//                 }
//             })
//             .catch(error => console.error('Error al obtener los horarios disponibles:', error));
//     }

//     // Eventos de cambio para actualizar los selectores dependientes
//     specialtySelect.addEventListener('change', loadDoctors);
//     doctorSelect.addEventListener('change', loadAvailableDates);
//     appointmentDateSelect.addEventListener('change', loadAvailableSchedules);
// });
