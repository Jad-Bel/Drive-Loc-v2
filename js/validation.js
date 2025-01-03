document.addEventListener('DOMContentLoaded', function() {
    // Validation for Add Vehicle Form
    const addVehicleForm = document.getElementById('addVehicleForm');
    const addVehicleButton = document.getElementById('addVehicleButton');

    addVehicleButton.addEventListener('click', function(e) {
        e.preventDefault();
        if (validateVehicleForm(addVehicleForm)) {
            // Form is valid, proceed with submission
            console.log('Add Vehicle form is valid');
            // Add your form submission logic here
        }
    });

    // Validation for Edit Vehicle Form
    const editVehicleForm = document.getElementById('editVehicleForm');
    const editVehicleButton = document.getElementById('editVehicleButton');

    editVehicleButton.addEventListener('click', function(e) {
        e.preventDefault();
        if (validateVehicleForm(editVehicleForm)) {
            // Form is valid, proceed with submission
            console.log('Edit Vehicle form is valid');
            // Add your form submission logic here
        }
    });

    function validateVehicleForm(form) {
        let isValid = true;

        // Validate Make
        const make = form.querySelector('#' + form.id.replace('Form', 'Make'));
        const makeError = document.getElementById(make.id + 'Error');
        if (!validateName(make.value)) {
            isValid = false;
            showError(make, makeError, 'Please enter a valid make (letters only)');
        } else {
            hideError(make, makeError);
        }

        // Validate Model
        const model = form.querySelector('#' + form.id.replace('Form', 'Model'));
        const modelError = document.getElementById(model.id + 'Error');
        if (!validateName(model.value)) {
            isValid = false;
            showError(model, modelError, 'Please enter a valid model (letters and numbers only)');
        } else {
            hideError(model, modelError);
        }

        // Validate Year
        const year = form.querySelector('#' + form.id.replace('Form', 'Year'));
        const yearError = document.getElementById(year.id + 'Error');
        if (!validateYear(year.value)) {
            isValid = false;
            showError(year, yearError, 'Please enter a valid year (1900-current year)');
        } else {
            hideError(year, yearError);
        }

        // Validate Price
        const price = form.querySelector('#' + form.id.replace('Form', 'Price'));
        const priceError = document.getElementById(price.id + 'Error');
        if (!validatePrice(price.value)) {
            isValid = false;
            showError(price, priceError, 'Please enter a valid price (positive number)');
        } else {
            hideError(price, priceError);
        }

        return isValid;
    }

    function validateName(name) {
        return /^[a-zA-Z0-9\s-]+$/.test(name);
    }

    function validateYear(year) {
        const currentYear = new Date().getFullYear();
        return /^\d{4}$/.test(year) && parseInt(year) >= 1900 && parseInt(year) <= currentYear;
    }

    function validatePrice(price) {
        return /^\d+(\.\d{1,2})?$/.test(price) && parseFloat(price) > 0;
    }

    function showError(input, errorElement, errorMessage) {
        input.classList.add('is-invalid');
        errorElement.textContent = errorMessage;
    }

    function hideError(input, errorElement) {
        input.classList.remove('is-invalid');
        errorElement.textContent = '';
    }
});

