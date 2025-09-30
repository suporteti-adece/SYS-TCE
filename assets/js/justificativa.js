document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('exigibilidade-form');
    if (!form) return;

    const justificativaRadios = document.querySelectorAll('input[name="justificativa_opt"]');
    const justificativaTexto = document.getElementById('justificativa_texto');
    const justificativaHidden = document.getElementById('justificativa');
    const justOutroRadio = document.getElementById('just_outro');

    const toggleTexto = () => {
        justificativaTexto.style.display = 'none';
        justificativaTexto.required = false;

        if (justOutroRadio && justOutroRadio.checked) {
            justificativaTexto.style.display = 'block';
            justificativaTexto.required = true;
        }
    };

    justificativaRadios.forEach(radio => {
        radio.addEventListener('change', toggleTexto);
    });

    form.addEventListener('submit', function(e) {
        const selectedRadio = document.querySelector('input[name="justificativa_opt"]:checked');
        if (!selectedRadio) return;

        let justificativaValue = selectedRadio.value;

        if (selectedRadio.id === 'just_outro') {
            justificativaValue = justificativaTexto.value;
        }

        justificativaHidden.value = justificativaValue;
    });

    toggleTexto();
});
