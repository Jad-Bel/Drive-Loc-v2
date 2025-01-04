document.getElementById('addVehicleForm').addEventListener('submit', function(event) {
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
