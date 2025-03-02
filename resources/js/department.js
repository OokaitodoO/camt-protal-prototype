console.log('Department JS loaded');

let currentCard = null;

function openEditPopup(element) {
    console.log('Opening popup...');
    const popup = document.getElementById('editPopup');
    console.log('Popup element:', popup);
    
    const departmentName = element.getAttribute('data-department');
    console.log('Department name:', departmentName);
    
    const input = document.getElementById('departmentName');
    console.log('Input element:', input);
    
    currentCard = element.closest('.department-card');
    console.log('Current card:', currentCard);
    
    input.value = departmentName;
    popup.style.display = 'flex';
}

function closeEditPopup() {
    const popup = document.getElementById('editPopup');
    popup.style.display = 'none';
}

function saveDepartmentName(event) {
    event.preventDefault();
    
    const newName = document.getElementById('departmentName').value;
    if (currentCard && newName.trim() !== '') {
        // Update the department name in the card
        currentCard.querySelector('.department-name').textContent = newName;
        currentCard.querySelector('.icon-action').setAttribute('data-department', newName);
        
        // AJAX request to update the backend
        axios.post('/update-department', { name: newName })
            .then(response => {
                console.log('Updated successfully');
                closeEditPopup();
            })
            .catch(error => console.error('Error updating department:', error));
    }
}

// Close popup when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.popup-overlay').addEventListener('click', function(event) {
        if (event.target === this) {
            closeEditPopup();
        }
    });
});

// Export functions to make them globally available
window.openEditPopup = openEditPopup;
window.closeEditPopup = closeEditPopup;
window.saveDepartmentName = saveDepartmentName; 