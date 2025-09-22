document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('exigibilidade-form');
    if (!form) {
        return;
    }

    const formatters = {
        cpf: (value) =>
            value
                .replace(/\D/g, '')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})$/, '$1-$2'),
        cnpj: (value) =>
            value
                .replace(/\D/g, '')
                .replace(/(\d{2})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1/$2')
                .replace(/(\d{4})(\d{1,2})$/, '$1-$2'),
        currency: (value) => {
            let cleanValue = value.replace(/\D/g, '');
            if (cleanValue === '') return '';
            let numberValue = (parseInt(cleanValue, 10) / 100).toFixed(2);
            let formattedValue = numberValue.replace('.', ',');
            return `R$ ${formattedValue}`;
        },
        padWithZeros: (value, maxLength) => value.padStart(maxLength, '0'),
    };

    const inputConfigs = {
        exercicio: { maxLength: 4, required: true, pad: true, numericOnly: true },
        semestre: { required: true },
        codFonteRecurso: { maxLength: 2, pad: true, numericOnly: true },
        tipoRecurso: { maxLength: 2, pad: true, numericOnly: true },
        tipoExigibilidade: { maxLength: 2, pad: true, numericOnly: true },
        numContratoEmprestimo: { maxLength: 30, pad: true },
        anoContratoEmprestimo: { isYear: true, maxLength: 4, numericOnly: true },
        numConvenio: { maxLength: 30, pad: true },
        anoConvenio: { isYear: true, maxLength: 4, numericOnly: true },
        numNotaFiscal: { maxLength: 30, required: true, pad: true },
        dataNotaFiscal: { isDate: true, required: true },
        dataAtesto: { isDate: true, required: true },
        idPagamento: { maxLength: 20, required: true, pad: true },
        dataPagamento: { isDate: true, required: true },
        valorPagamento: { isCurrency: true, required: true, numericOnly: true },
        numContrato: { maxLength: 30, pad: true },
        anoContrato: { isYear: true, maxLength: 4, numericOnly: true },
        valorContratacao: { isCurrency: true, required: true, numericOnly: true },
        cpfCnpjCredor: { isCpfCnpj: true, required: true, maxLength: 18, numericOnly: true },
    };

    const restrictInput = (e) => {
        const { id } = e.target;
        const config = inputConfigs[id];

        if (!config || !config.numericOnly) {
            return;
        }

        if ([46, 8, 9, 27, 13, 110].includes(e.keyCode) ||
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }

        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    };

    const applyMask = (e) => {
        const { id, value } = e.target;
        const config = inputConfigs[id];

        if (config.isCpfCnpj) {
            e.target.value = value.length <= 14 ? formatters.cpf(value) : formatters.cnpj(value);
            return;
        }
        if (config.isCurrency) {
            e.target.value = formatters.currency(value);
        }
    };

    const validateField = (field) => {
        const config = inputConfigs[field.id];
        if (!config) return true;

        let isValid = true;
        let errorMessage = '';

        if (config.required && !field.value.trim()) {
            isValid = false;
            errorMessage = 'Este campo é obrigatório.';
        } else if ((field.id === 'exercicio' || config.isYear) && field.value) {
            const currentYear = new Date().getFullYear();
            const yearValue = parseInt(field.value, 10);
            if (!/^\d{4}$/.test(field.value)) {
                isValid = false;
                errorMessage = 'O ano deve ter 4 dígitos.';
            } else if (yearValue < 2015 || yearValue > currentYear) {
                isValid = false;
                errorMessage = `O ano deve ser entre 2015 e ${currentYear}.`;
            }
        } else if (config.isCpfCnpj && field.value && !isValidCpfCnpj(field.value)) {
            isValid = false;
            errorMessage = 'CPF ou CNPJ inválido.';
        }

        updateFieldValidationUI(field, isValid, errorMessage);
        return isValid;
    };

    const updateFieldValidationUI = (field, isValid, message) => {
        removeError(field);
        if (isValid) {
            field.classList.remove('is-invalid');
        } else {
            field.classList.add('is-invalid');
            showError(field, message);
        }
    };

    const showError = (field, message) => {
        const error = document.createElement('div');
        error.className = 'invalid-feedback';
        error.innerText = message;
        field.parentNode.appendChild(error);
    };

    const removeError = (field) => {
        const error = field.parentNode.querySelector('.invalid-feedback');
        if (error) {
            error.remove();
        }
    };

    const isValidCpfCnpj = (value) => {
        const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
        const cnpjRegex = /^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/;
        return cpfRegex.test(value) || cnpjRegex.test(value);
    };

    const handleSubmit = (e) => {
        let isFormValid = true;
        Object.keys(inputConfigs).forEach((id) => {
            const field = document.getElementById(id);
            if (field && !validateField(field)) {
                isFormValid = false;
            }
        });

        if (!isFormValid) {
            e.preventDefault();
            return;
        }

        Object.keys(inputConfigs).forEach((id) => {
            const field = document.getElementById(id);
            const config = inputConfigs[id];
            if (field && config.pad && field.value) {
                let valueToPad = field.value;
                if (config.isCurrency) {
                    valueToPad = valueToPad.replace(/\D/g, '');
                }
                field.value = formatters.padWithZeros(valueToPad, config.maxLength);
            }
        });
    };

    form.addEventListener('submit', handleSubmit);
    document.querySelectorAll('input').forEach((input) => {
        input.addEventListener('keydown', restrictInput);
        input.addEventListener('input', applyMask);
        input.addEventListener('blur', (e) => validateField(e.target));
    });
});
