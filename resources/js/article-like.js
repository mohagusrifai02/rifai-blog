const likeContainer = document.querySelector('#article-like');
const likeForm = document.querySelector('#like-form');

if (likeContainer && likeForm) {
    const likeButton = document.querySelector('#like-button');
    const likesCount = document.querySelector('#likes-count');
    const likeError = document.querySelector('#like-error');

    likeForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (likeButton.disabled) return;

        likeButton.disabled = true;
        likeError.textContent = '';

        try {
            const response = await fetch(likeContainer.dataset.url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': likeForm.querySelector(
                        'input[name="_token"]'
                    ).value,
                },
            });

            if (!response.ok) {
                throw new Error('Gagal memperbarui like.');
            }

            const data = await response.json();

            likeButton.dataset.liked = String(data.liked);
            likeButton.textContent = data.liked ? 'Unlike' : 'Like';

            likeButton.classList.toggle('bg-red-600', data.liked);
            likeButton.classList.toggle('text-white', data.liked);
            likeButton.classList.toggle('bg-gray-200', !data.liked);
            likeButton.classList.toggle('text-gray-800', !data.liked);

            likesCount.textContent = Number(data.likes_count).toLocaleString(
                'id-ID'
            );
        } catch (error) {
            likeError.textContent =
                'Like gagal diperbarui. Silakan coba lagi.';
        } finally {
            likeButton.disabled = false;
        }
    });
}
