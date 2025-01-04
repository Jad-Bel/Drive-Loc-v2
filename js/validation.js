document.getElementById('addVehicleForm').addEventListener('submit', function (event) {
    let isValid = true;

    const regexPatterns = {
        marque: /^[A-Za-z\s]{3,}$/,
        vhc_name: /^[A-Za-z0-9\s]{3,}$/,
        model: /^[0-9]{4}$/,
        vhc_image: /^(https?:\/\/)?([a-zA-Z0-9]+[\-\.])*([a-zA-Z0-9]+)\.([a-zA-Z]{2,})$/,
        disponibilite: /^[0-1]$/,
        mileage: /^[0-9]+$/,
        transmition: /^[A-Za-z\s]+$/,
        prix: /^[0-9]+(\.[0-9]{1,2})?$/,
        description: /^[A-Za-z0-9\s]{5,}$/
    };

    function validateField(input, regex, errorMessageElement) {
        const value = input.value.trim();
        if (!value.match(regex)) {
            isValid = false;
            errorMessageElement.innerText = `Invalid ${input.name}. Please follow the correct format.`;
            errorMessageElement.style.display = 'block';
            input.classList.add('is-invalid');
        } else {
            errorMessageElement.style.display = 'none';
            input.classList.remove('is-invalid');
        }
    }

    validateField(document.getElementById('vehicleMake'), regexPatterns.marque, document.getElementById('vehicleMakeError'));
    validateField(document.getElementById('editVehicleName'), regexPatterns.vhc_name, document.getElementById('editVehicleMakeError'));
    validateField(document.getElementById('vehicleModelInput'), regexPatterns.model, document.getElementById('vehicleYearError'));
    validateField(document.getElementById('vehicleImage'), regexPatterns.vhc_image, document.getElementById('vehicleImageError'));
    validateField(document.getElementById('vehicleDisponibilite'), regexPatterns.disponibilite, document.getElementById('vehicleDispError'));
    validateField(document.getElementById('vehicleMileage'), regexPatterns.mileage, document.getElementById('vehicleMileageError'));
    validateField(document.getElementById('vehicleTransmission'), regexPatterns.transmition, document.getElementById('vehicleTransError'));
    validateField(document.getElementById('vehiclePrice'), regexPatterns.prix, document.getElementById('vehiclePriceError'));
    validateField(document.getElementById('vehicleDescription'), regexPatterns.description, document.getElementById('vehicleDesError'));

    if (!isValid) {
        event.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Please correct the errors in the form.',
            icon: 'error',
            confirmButtonText: 'Close'
        });
    }
});

const btn = document.querySelector('.btn.btn-sm.btn-primary');
btn.addEventListener('click', () => {
    const row = btn.closest('tr');
    if (row) {
        const head = row.querySelectorAll('td');
        document.querySelector('#editVehicleIdInput').value = head[0].textContent.trim(); 
        document.querySelector('#editVehicleMakeInput').value = head[1].textContent.trim(); 
        document.querySelector('#editVehicleNameInput').value = head[2].textContent.trim(); 
        document.querySelector('#editVehicleModelInput').value = head[3].textContent.trim();
        document.querySelector('#editVehicleImgInput').value = head[4].textContent.trim();
        document.querySelector('#editVehicleDisponibiliteInput').value =
            head[5].textContent.trim() === "Available" ? 1 : 0; 
            document.querySelector('#editVehicleMileageInput').value = head[6].textContent.trim().replace('Km', ''); 
        document.querySelector('#editVehicleTransmissionInput').value = head[7].textContent.trim();
        document.querySelector('#editVehiclePriceInput').value = head[8].textContent.trim().replace('$', '');
        document.querySelector('#editVehicleDescriptionInput').value = head[9].textContent.trim().replace('$', '');
        console.log(1);
    }

    const modal = new bootstrap.Modal(document.getElementById('editVehicleModal'));
    modal.show();
})


document.getElementById('editVehicleButton').addEventListener('click', function (event) {
    let isValid = true;

    const regexPatterns = {
        marque: /^[A-Za-z\s]{3,}$/,
        vhc_name: /^[A-Za-z0-9\s]{3,}$/,
        model: /^[0-9]{4}$/,
        // vhc_image: /^(https?:\/\/)?([a-zA-Z0-9]+[\-\.])*([a-zA-Z0-9]+)\.([a-zA-Z]{2,})$/,
        disponibilite: /^[0-1]$/,
        mileage: /^[0-9]+$/,
        transmission: /^[A-Za-z\s]+$/,
        prix: /^[0-9]+(\.[0-9]{1,2})?$/,
        description: /^[A-Za-z0-9\s]{5,}$/
    };

    function validateField(input, regex, errorMessageElement) {
        const value = input.value.trim();
        if (!value.match(regex)) {
            isValid = false;
            errorMessageElement.innerText = `Invalid ${input.name}. Please follow the correct format.`;
            errorMessageElement.style.display = 'block';
            input.classList.add('is-invalid');
        } else {
            errorMessageElement.style.display = 'none';
            input.classList.remove('is-invalid');
        }
    }

    validateField(document.getElementById('editVehicleMakeInput'), regexPatterns.marque, document.getElementById('editVehicleMakeError'));
    validateField(document.getElementById('editVehicleNameInput'), regexPatterns.vhc_name, document.getElementById('editVehicleNameError'));
    validateField(document.getElementById('editVehicleModelInput'), regexPatterns.model, document.getElementById('editVehicleModelError'));
    // validateField(document.getElementById('editVehicleImgInput'), regexPatterns.vhc_image, document.getElementById('editVehicleImgError'));
    validateField(document.getElementById('editVehicleDisponibiliteInput'), regexPatterns.disponibilite, document.getElementById('editVehicleDisponibiliteError'));
    validateField(document.getElementById('editVehicleMileageInput'), regexPatterns.mileage, document.getElementById('editVehicleMileageError'));
    validateField(document.getElementById('editVehicleTransmissionInput'), regexPatterns.transmission, document.getElementById('editVehicleTransmissionError'));
    validateField(document.getElementById('editVehiclePriceInput'), regexPatterns.prix, document.getElementById('editVehiclePriceError'));
    validateField(document.getElementById('editVehicleDescriptionInput'), regexPatterns.description, document.getElementById('editVehicleDescriptionError'));

    if (!isValid) {
        event.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Please correct the errors in the form.',
            icon: 'error',
            confirmButtonText: 'Close'
        });
    }
});

