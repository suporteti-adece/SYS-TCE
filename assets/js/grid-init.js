document.addEventListener('DOMContentLoaded', () => {
    const table = document.querySelector('table.js-grid');
    if (!table) return;

    const filterExercicio = document.getElementById('filterExercicio');
    const filterSemestre = document.getElementById('filterSemestre');

    const numericSort = (a, b) => {
        const parseCurrency = (value) => {
            if (typeof value !== 'string') {
                value = String(value);
            }
            const numberString = value.replace(/\./g, '').replace(',', '.').replace(/[^0-9.-]/g, '');

            return parseFloat(numberString) || 0;
        };

        const aNum = parseCurrency(a);
        const bNum = parseCurrency(b);

        if (aNum > bNum) {
            return 1;
        } else if (bNum > aNum) {
            return -1;
        }
        return 0;
    };

    const dateSort = (a, b) => {
        const parseDate = (dateStr) => {
            if (!dateStr || typeof dateStr !== 'string') return 0;
            const parts = dateStr.split('/');
            if (parts.length !== 3) return 0;
            return new Date(parts[2], parts[1] - 1, parts[0]).getTime();
        };
        const aDate = parseDate(a);
        const bDate = parseDate(b);
        if (aDate > bDate) return 1;
        if (bDate > aDate) return -1;
        return 0;
    };

    const columns = Array.from(table.querySelectorAll('thead th')).map(th => {
        const columnName = th.textContent.trim();

        switch (columnName) {
            case 'Exercício':
                return {
                    name: columnName,
                    width: '120px',
                    sort: false
                };
            case 'Semestre':
                return {
                    name: columnName,
                    width: '120px',
                    sort: false
                };
            case 'Órgão':
                return {
                    name: columnName,
                    width: '120px',
                    sort: false
                };
            case 'Fonte de Recurso':
                return {
                    name: columnName,
                    width: '150px',
                    sort: {
                        compare: numericSort
                    }
                };
            case 'Tipo de Recurso':
                return {
                    name: columnName,
                    width: '160px'
                };
            case 'Nº Contrato Emprestimo':
                return {
                    name: columnName,
                    minWidth: '310px',
                    sort: false
                };
            case 'Ano Convênio':
                return {
                    name: columnName,
                    width: '150px',
                    sort: {
                        compare: numericSort
                    }
                };
            case 'Nº do Convênio':
                return {
                    name: columnName,
                    minWidth: '310px',
                    sort: false
                }
            case 'Nº Nota fiscal':
                return {
                    name: columnName,
                    width: '310px',
                    sort: false
                };
            case 'Data NF':
                return {
                    name: columnName,
                    sort: {
                        compare: dateSort
                    }
                }
            case 'Data Atesto':
                return {
                    name: columnName,
                    sort: {
                        compare: dateSort
                    }
                };
            case 'Id Pagamento':
                return {
                    name: columnName,
                    minWidth: '200px',
                    sort: {
                        compare: numericSort
                    }
                };
            case 'Data Pagamento':
                return {
                    name: columnName,
                    sort: {
                        compare: dateSort
                    }
                };
            case 'Valor do Pagamento':
                return {
                    name: columnName,
                    minWidth: '280px',
                    sort: {
                        compare: numericSort
                    }
                }
            case 'Valor da Contratação':
                return {
                    name: columnName,
                    minWidth: '280px',
                    sort: {
                        compare: numericSort
                    }
                };
            case 'Nº Contrato':
                return {
                    name: columnName,
                    minWidth: '310px',
                    sort: false
                };
            case 'Ano Contrato':
                return {
                    name: columnName,
                    minWidth: '210px',
                    sort: {
                        compare: numericSort
                    }
                };
            case 'Razão Social':
                return {
                    name: columnName,
                    minWidth: '310px',
                    sort: false
                };
            case 'Ações':
                return {
                    name: columnName,
                    sort: false
                };
            default:
                return {
                    name: columnName,
                    minWidth: '200px'
                };
        }
    });

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
        columns: columns,
        data: buildGridDataFromRows(originalRows),
        search: false,
        pagination: { enabled: true, limit: 20 },
        sort: true,
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

    if (filterExercicio) filterExercicio.addEventListener('change', applyFilters);
    if (filterSemestre) filterSemestre.addEventListener('change', applyFilters);
});
