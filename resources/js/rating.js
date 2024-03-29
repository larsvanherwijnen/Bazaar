document.querySelectorAll('input[name="rating"]').forEach((star, index, starList) => {
    star.addEventListener('change', () => {
        // Fill this star and all stars before it
        for (let i = 0; i <= index; i++) {
            document.querySelector(`label[for="star${starList[i].value}"]`).textContent = '★';
        }
        // Empty all stars after this one
        for (let i = index + 1; i < starList.length; i++) {
            document.querySelector(`label[for="star${starList[i].value}"]`).textContent = '☆';
        }
    });
});

    let form = document.querySelector('#form1');
    form.addEventListener('submit', function (event) {
        let errorMessage = form.querySelector('.rating-error');
        const selectedRating = document.querySelector('input[name="rating"]:checked');
        if (!selectedRating) {
            event.preventDefault(); // Prevent form submission
            if (errorMessage) {
                errorMessage.textContent = errorMessage.dataset.errorMessage;
            }
        } else {
            if (errorMessage) {
                errorMessage.textContent = ''; // Clear the error message if a rating is selected
            }
        }
    });