document.addEventListener('DOMContentLoaded', function() {
    const specialtySelect = document.getElementById('specialty_id');
    const doctorSelect = document.getElementById('doctor_id');
    const appointmentDateSelect = document.getElementById('appointment_date');
    const availableSchedulesSelect = document.getElementById('available_schedules');

    // Función para resetear el campo de horarios disponibles
    function resetAvailableSchedules() {
        availableSchedulesSelect.innerHTML = '<option value="">Seleccionar Horario</option>';
    }

    // Cargar doctores al seleccionar una especialidad
    specialtySelect.addEventListener('change', function() {
        const specialtyId = this.value;
        doctorSelect.innerHTML = '<option value="">Seleccionar Doctor</option>';
        resetAvailableSchedules(); // Resetear horarios al cambiar especialidad

        if (specialtyId) {
            fetch(`/doctors/by-specialty/${specialtyId}`)
                .then(response => response.json())
                .then(doctors => {
                    doctors.forEach(doctor => {
                        const option = document.createElement('option');
                        option.value = doctor.id;
                        option.text = `${doctor.person.first_name} ${doctor.person.last_name}`;
                        doctorSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al obtener los doctores:', error));
        }
    });

    // Cargar días disponibles al seleccionar un doctor
    doctorSelect.addEventListener('change', function() {
        const doctorId = this.value;
        appointmentDateSelect.innerHTML = '<option value="">Seleccionar Día</option>';
        resetAvailableSchedules(); // Resetear horarios al cambiar doctor

        if (doctorId) {
            fetch(`/doctors/${doctorId}/available-days`)
                .then(response => response.json())
                .then(dates => {
                    dates.forEach(dateString => {
                        const option = document.createElement('option');
                        option.value = dateString;
                        option.text = dateString.split('-').reverse().join('-'); // Mostrar como DD-MM-YYYY
                        appointmentDateSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al obtener los días disponibles:', error));
        }
    });

    // Cargar horarios disponibles al seleccionar un día
    appointmentDateSelect.addEventListener('change', function() {
        const doctorId = doctorSelect.value;
        const selectedDate = this.value;
        resetAvailableSchedules(); // Resetear horarios al cambiar fecha

        if (doctorId && selectedDate) {
            fetch(`/doctors/${doctorId}/available-schedules?date=${selectedDate}`)
                .then(response => response.json())
                .then(slots => {
                    slots.forEach(slot => {
                        const option = document.createElement('option');
                        option.value = JSON.stringify({
                            schedule_id: slot.id,
                            time: slot.time
                        });
                        option.text = slot.time;
                        availableSchedulesSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al obtener los horarios disponibles:', error));
        }
    });
});