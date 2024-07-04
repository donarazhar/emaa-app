function toggleDetails(cardId) {
    var detailCard = document.getElementById('details-' + cardId);
    if (detailCard.style.display === 'none' || detailCard.style.display === '') {
        detailCard.style.display = 'block';
    } else {
        detailCard.style.display = 'none';
    }
}