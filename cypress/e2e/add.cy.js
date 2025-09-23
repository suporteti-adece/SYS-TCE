describe('Cadastro de Exigibilidades', () => {
    it('Deve cadastrar 30 exigibilidades com sucesso', () => {
        const getRandomOption = (options) => options[Math.floor(Math.random() * options.length)];

        for (let i = 0; i < 30; i++) {
            cy.visit('/exigibilidades/criar');

            cy.get('#exercicio').type('2025');
            cy.get('#semestre').select(getRandomOption(['01', '02']));
            cy.get('#codFonteRecurso').type(Math.floor(Math.random() * 90 + 10).toString());
            cy.get('#tipoRecurso').select(getRandomOption(['00', '01', '02']));
            cy.get('#tipoExigibilidade').select(getRandomOption(['01', '02', '03', '04']));
            cy.get('#numContratoEmprestimo').type(`CONTRATO-${i}`);
            cy.get('#anoContratoEmprestimo').type('2025');
            cy.get('#numConvenio').type(`CONVENIO-${i}`);
            cy.get('#anoConvenio').type('2025');
            cy.get('#numNotaFiscal').type(Math.floor(Math.random() * 1000).toString());
            cy.get('#dataNotaFiscal').type('2025-01-15');
            cy.get('#dataAtesto').type('2025-01-16');
            cy.get('#idPagamento').type(`PAG-${i}`);
            cy.get('#dataPagamento').type('2025-01-17');
            cy.get('#valorPagamento').type('1000,00');
            cy.get('#numContrato').type(`CT-${i}`);
            cy.get('#anoContrato').type('2025');
            cy.get('#valorContratacao').type('5000,00');
            cy.get('#cpfCnpjCredor').type(generateCpf());
            cy.get('#justificativa').type(`Justificativa do teste ${i + 22}`);

            cy.get('form#exigibilidade-form').submit();

            cy.contains('Exigibilidade cadastrada com sucesso!').should('be.visible');
        }
    });
});

function generateCpf() {
    const rnd = (n) => Math.round(Math.random() * n);
    const mod = (base, div) => Math.round(base - Math.floor(base / div) * div);
    const n = Array(9).fill(0).map(() => rnd(9));
    let d1 = n.map((v, i) => v * (10 - i)).reduce((acc, v) => acc + v, 0);
    d1 = 11 - mod(d1, 11);
    if (d1 >= 10) d1 = 0;
    let d2 = (n.concat(d1)).map((v, i) => v * (11 - i)).reduce((acc, v) => acc + v, 0);
    d2 = 11 - mod(d2, 11);
    if (d2 >= 10) d2 = 0;
    return `${n.join('')}${d1}${d2}`;
}
