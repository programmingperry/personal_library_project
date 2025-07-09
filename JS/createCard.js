/**
 * Erstellt ein Element in Form einer Card für ein Buch
 * @param {object} book - das Buch? 
 * @returns - gibt das erstellt Element zurück
 */
function createCardElement(book) {

    const card = document.createElement('div');
    card.classList.add('card', 'm-2');
    card.style.width = '25rem'

    const image = document.createElement('img');
    image.setAttribute('src', `images/${book.image}`);
    card.appendChild(image);

    const cardBody = document.createElement('div');
    cardBody.classList.add('card-body');
    card.appendChild(cardBody);

    const cardTitle = document.createElement('h5');
    cardTitle.classList.add('card-title');
    cardTitle.textContent = book.bookTitle;
    cardBody.appendChild(cardTitle);

    return card;
}

export { createCardElement };
