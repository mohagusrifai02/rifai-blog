import Quill from 'quill';
import 'quill/dist/quill.snow.css';

document.addEventListener('DOMContentLoaded', function () {
    const editorElement = document.getElementById('editor');
    const contentInput = document.getElementById('content');

    if (!editorElement || !contentInput) {
        return;
    }

    
    function imageHandler() {
        const input = document.createElement('input');

        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/jpeg,image/png,image/webp');

        input.click();

        input.addEventListener('change', async function () {
            const file = input.files?.[0];

            if (!file) {
                return;
            }

            const formData = new FormData();
            formData.append('image', file);

            try {
                const response = await fetch('/upload-gambar', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        )?.getAttribute('content') ?? '',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(
                        result.message || 'Gagal mengunggah gambar.'
                    );
                }

                const range = quill.getSelection(true);

                quill.insertEmbed(range.index, 'image', result.url, 'user');
                quill.setSelection(range.index + 1, 0, 'silent');
            } catch (error) {
                alert(error.message || 'Terjadi kesalahan saat upload gambar.');
            }
        });
    }

    const quill = new Quill(editorElement, {
        theme: 'snow',
        placeholder: 'Tulis isi artikel di sini...',
        modules: {
            toolbar: {
                container: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['blockquote', 'link', 'image'],
                    ['clean']
                ],
                handlers: {
                    image: imageHandler
                }
            }
        }
    });

    const initialContent = contentInput.value;

    if (initialContent) {
        quill.root.innerHTML = initialContent;
    }

    const form = editorElement.closest('form');

    if (form) {
        form.addEventListener('submit', function () {
            contentInput.value = quill.root.innerHTML;
        });
    }
});
