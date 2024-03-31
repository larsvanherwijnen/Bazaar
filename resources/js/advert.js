
document.getElementById('images').addEventListener('change', function() {
    const preview = document.querySelector('#image-preview');
    const files = this.files;

    // get all image placeholders
    const placeholders = Array.from(preview.querySelectorAll('.image-placeholder'));
    // get amount of images already in preview
    let totalImages = parseInt(document.getElementById('totalImages').value) || 0;
    totalImages += files.length;

    let maxImages = parseInt(this.dataset.maxImages);
    if (totalImages > maxImages) {
        alert('You can only upload a maximum of ' + maxImages + ' images');
        this.value = ''; // Clear the file input field
        return; // Exit the function
    }

    Array.from(files).forEach((file, i) => {
        const img = document.createElement('img');
        img.file = file;

        // if placeholder replace with image, else append
        const placeholder = placeholders[i];
        if (placeholder) {
            placeholder.replaceWith(img);
        } else {
            preview.appendChild(img);
        }

        // set same size as placeholder (container)
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';

        // make first image bigger
        if (totalImages === 1) {
            img.classList.add('object-cover', 'col-span-2', 'row-span-2');
        } else {
            img.classList.add('object-cover', 'col-span-1', 'row-span-1');
        }

        const reader = new FileReader();
        reader.onload = e => img.src = e.target.result;
        reader.readAsDataURL(file);
    });

    // update total images
    document.getElementById('totalImages').value = totalImages;
    document.querySelector('.text-green-600').textContent = `${totalImages} of 5 photos used!`;
});
