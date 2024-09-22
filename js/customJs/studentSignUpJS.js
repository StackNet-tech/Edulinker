function nextStep(step) {
    document.querySelectorAll('.form-step').forEach(function (el) {
        el.classList.remove('active');
        // Disable validation for hidden steps
        el.querySelectorAll('input, select').forEach(input => input.setAttribute('disabled', 'disabled'));
    });
    let activeStep = document.querySelector('#step-' + step);
    activeStep.classList.add('active');
    activeStep.querySelectorAll('input, select').forEach(input => input.removeAttribute('disabled'));

    document.querySelectorAll('.step').forEach(function (el) {
        el.classList.remove('active');
    });
    document.querySelector('.step:nth-child(' + step + ')').classList.add('active');
}

function prevStep(step) {
    document.querySelectorAll('.form-step').forEach(function (el) {
        el.classList.remove('active');
        // Disable validation for hidden steps
        el.querySelectorAll('input, select').forEach(input => input.setAttribute('disabled', 'disabled'));
    });
    let activeStep = document.querySelector('#step-' + step);
    activeStep.classList.add('active');
    activeStep.querySelectorAll('input, select').forEach(input => input.removeAttribute('disabled'));

    document.querySelectorAll('.step').forEach(function (el) {
        el.classList.remove('active');
    });
    document.querySelector('.step:nth-child(' + step + ')').classList.add('active');
}
