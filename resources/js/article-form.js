// Slug generation
document.addEventListener('DOMContentLoaded', function(){
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    titleInput.addEventListener('input', function(){
        slugInput.value = titleInput.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
    });
});

// Image preview
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('image-preview');

if (imageInput && imagePreview) {
    let previewUrl = null;

    imageInput.addEventListener('change', function () {
        const file = this.files?.[0];

        // Bersihkan preview sebelumnya
        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file || !file.type.startsWith('image/')) {
            imagePreview.src = '';
            imagePreview.classList.add('hidden');
            return;
        }

        previewUrl = URL.createObjectURL(file);
        imagePreview.src = previewUrl;
        imagePreview.classList.remove('hidden');
    });
}
