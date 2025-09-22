document.addEventListener('DOMContentLoaded', function() {
    const exportButton = document.getElementById('export-btn-xml');
    if (exportButton) {
        exportButton.addEventListener('click', function(event) {
            event.preventDefault();

            const exercicio = document.getElementById('filterExercicio').value;
            const semestre = document.getElementById('filterSemestre').value;

            const baseUrl = this.getAttribute('href');
            const urlComFiltros = `${baseUrl}?exercicio=${exercicio}&semestre=${semestre}`;
            window.location.href = urlComFiltros;
        });
    }

    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const exigibilidadeId = button.getAttribute('data-id');
            const deleteForm = document.getElementById('deleteForm');
            const action = `/exigibilidades/${exigibilidadeId}/deletar`;
            deleteForm.setAttribute('action', action);
        });
    }

    const alerts = document.querySelectorAll('.alert-dismissible');

    alerts.forEach(function(alert) {
        setTimeout(function() {
            new bootstrap.Alert(alert).close();
        }, 3000);
    });
});
