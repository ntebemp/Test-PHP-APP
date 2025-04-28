
// Open modal
const addButton = document.getElementById('addButton');
const modal = document.getElementById('modal');
const closeModal = document.getElementById('closeModal');

addButton.addEventListener('click', () => {
  document.getElementById('modalTitle').innerText = "Add a brand";
  modal.classList.remove('hidden');
});

const editButton = document.getElementById('editButton');


closeModal.addEventListener('click', () => {
  modal.classList.add('hidden');
});


function displayRating(rating, brandId) {
    const ratingContainer = document.getElementById(`rating-display-${brandId}`);
    let stars = '';

    for (let i = 0; i < Math.floor(rating); i++) {
        stars += '★';
    }

    if (rating % 1 !== 0) {
        stars += '☆'; 
    }

    for (let i = Math.floor(rating); i < 5; i++) {
        stars += '☆'; 
    }

    ratingContainer.innerHTML = stars + ` ${rating}`; 
}


