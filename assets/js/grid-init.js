document.addEventListener('DOMContentLoaded', () => {
    const table = document.querySelector('table.js-grid');
    if (!table) return;

    const filterExercicio = document.getElementById('filterExercicio');
    const filterSemestre = document.getElementById('filterSemestre');

    const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());

    const tbodyRows = Array.from(table.querySelectorAll('tbody tr'));
    const originalRows = tbodyRows.map(tr => {
        const tds = Array.from(tr.querySelectorAll('td'));
        const cellsText = tds.slice(0, -1).map(td => td.textContent.trim());
        const actionsHtml = (tds[tds.length - 1] && tds[tds.length - 1].innerHTML) || '';
        return { cellsText, actionsHtml };
    });

    const wrapper = document.createElement('div');
    table.parentNode.insertBefore(wrapper, table);

    const gridContainer = document.createElement('div');
    wrapper.appendChild(gridContainer);

    const noResults = document.createElement('div');
    noResults.className = 'alert alert-info mt-3';
    noResults.textContent = 'Nenhum registro encontrado para os filtros selecionados.';
    noResults.style.display = 'none';
    wrapper.appendChild(noResults);

    const buildGridDataFromRows = rows =>
        rows.map(r => [...r.cellsText, gridjs.html(r.actionsHtml)]);

    const grid = new gridjs.Grid({
        columns: headers,
        data: buildGridDataFromRows(originalRows),
        search: false,
        pagination: { enabled: true, limit: 20 },
        sort: false,
        className: {
            table: 'table table-striped table-hover',
            th: 'table-dark'
        },
        language: {
            pagination: {
                previous: 'Anterior',
                next: 'Próximo',
                showing: 'Mostrando',
                results: () => 'Resultados',
                to: 'a',
                of: 'de'
            },
            noRecordsFound: 'Nenhum registro encontrado para os filtros selecionados.'
        }
    });

    grid.render(gridContainer);

    table.remove();

    const applyFilters = () => {
        const exercicio = filterExercicio ? filterExercicio.value : '';
        const semestre = filterSemestre ? filterSemestre.value : '';

        const filtered = originalRows.filter(r => {
            const matchExercicio = !exercicio || (r.cellsText[0] === exercicio);
            const matchSemestre = !semestre || (r.cellsText[1] === semestre);
            return matchExercicio && matchSemestre;
        });

        if (filtered.length === 0) {
            gridContainer.style.display = 'none';
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
            gridContainer.style.display = '';
            grid.updateConfig({ data: buildGridDataFromRows(filtered) }).forceRender();
        }
    };

    // Listeners
    if (filterExercicio) filterExercicio.addEventListener('change', applyFilters);
    if (filterSemestre) filterSemestre.addEventListener('change', applyFilters);
});
