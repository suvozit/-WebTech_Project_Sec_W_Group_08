document.addEventListener('DOMContentLoaded', function () {

    const form       = document.getElementById('payment-form');
    const errorMsg   = document.getElementById('payment-error');

    if (!form) return;

    form.addEventListener('submit', function (e) {

        const selected = form.querySelector('input[name="payment_method"]:checked');

        if (!selected) {
            e.preventDefault();                  
            errorMsg.style.display = 'block';   
            return;
        }

        errorMsg.style.display = 'none';
    });

    const radios = form.querySelectorAll('input[name="payment_method"]');
    radios.forEach(function (radio) {
        radio.addEventListener('change', function () {
            errorMsg.style.display = 'none';
        });
    });

});