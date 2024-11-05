document.addEventListener('DOMContentLoaded', () => {
    const toasts = document.querySelectorAll('.toast');
    toasts.forEach(toast => {
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 600);
        }, 3000);
    });

    document.querySelectorAll('form[method="POST"]').forEach(form => {
        form.addEventListener('submit', (e) => {
            if (form.querySelector('input[name="_method"]').value === 'DELETE') {
                e.preventDefault();

                if (confirm('¿Está seguro de que desea eliminar este turno?')) {
                    form.submit();
                    setTimeout(() => {
                        window.location
                            .reload();
                    }, 500);
                }
            }
        });
    });
});