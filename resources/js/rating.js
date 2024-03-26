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