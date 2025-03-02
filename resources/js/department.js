console.log('Department JS loaded');

let currentCard = null;

function openEditPopup(element) {
    console.log('Opening edit popup...');
    const popup = document.getElementById('editPopup');
    console.log('Edit popup element:', popup);
    
    const departmentName = element.getAttribute('data-department');
    console.log('Department name:', departmentName);
    
    const input = document.getElementById('departmentName');
    console.log('Input element:', input);
    
    currentCard = element.closest('.department-card');
    console.log('Current card:', currentCard);
    
    if (popup && input && currentCard) {
        input.value = departmentName;
        popup.style.display = 'flex';
    } else {
        console.error('Some elements not found');
    }
}

function closeEditPopup() {
    console.log('Closing edit popup...');
    const popup = document.getElementById('editPopup');
    if (popup) {
        popup.style.display = 'none';
        // Reset current card
        currentCard = null;
    }
}

function handleEditKeyPress(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        const newName = event.target.value;
        if (newName.trim() !== '') {
            saveDepartmentName(event);
        }
    } else if (event.key === 'Escape') {
        closeEditPopup();
    }
}

function saveDepartmentName(event) {
    event.preventDefault();
    console.log('Saving department name...');
    
    const newName = document.getElementById('departmentName').value;
    if (currentCard && newName.trim() !== '') {
        // Update the department name in the card
        const departmentNameElement = currentCard.querySelector('.department-name');
        const iconActionElement = currentCard.querySelector('.icon-action');
        
        if (departmentNameElement && iconActionElement) {
            departmentNameElement.textContent = newName;
            iconActionElement.setAttribute('data-department', newName);
            
            // Add animation class
            currentCard.classList.add('updated');
            
            // Close popup immediately
            closeEditPopup();
            
            // AJAX request to update the backend
            axios.post('/update-department', { name: newName })
                .then(response => {
                    console.log('Updated successfully');
                })
                .catch(error => {
                    console.error('Error updating department:', error);
                });
        }
    } else {
        console.error('Current card not found or new name is empty');
    }
}

// Add these new functions
function openCreatePopup() {
    console.log('Opening create popup...');
    const popup = document.getElementById('createPopup');
    if (popup) {
        popup.style.display = 'flex';
    } else {
        console.error('Create popup element not found');
    }
}

function closeCreatePopup() {
    console.log('Closing create popup...');
    const popup = document.getElementById('createPopup');
    if (popup) {
        popup.style.display = 'none';
    }
}

function createDepartment(event) {
    event.preventDefault();
    
    const newName = document.getElementById('newDepartmentName').value;
    if (newName.trim() !== '') {
        // Create new department card
        const container = document.querySelector('.content-container');
        const newCard = createDepartmentCard(newName);
        container.appendChild(newCard);
        
        // Clear input and close popup
        document.getElementById('newDepartmentName').value = '';
        closeCreatePopup();
        
        // AJAX request to create in backend
        axios.post('/create-department', { name: newName })
            .catch(error => console.error('Error creating department:', error));
    }
}

function createDepartmentCard(name) {
    const card = document.createElement('div');
    card.className = 'department-card new';
    
    card.innerHTML = `
        <div class="card-edit">
            <span><a href="#" class="icon-action" onclick="openEditPopup(this)" data-department="${name}">
                <i class="fas fa-edit"></i> แก้ไข
            </a></span>
        </div>
        <div class="card-content">
            <span><i class="fas fa-building fa-3x"></i></span>
            <p class="department-name">${name}</p>
        </div>
    `;
    
    return card;
}

// Add to your existing event listeners
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, setting up listeners...');
    
    // Add click listener to create button as backup
    const createBtn = document.querySelector('.create-btn');
    if (createBtn) {
        console.log('Create button found');
        createBtn.addEventListener('click', openCreatePopup);
    } else {
        console.log('Create button not found');
    }
    
    // Add click listener to popup overlay for closing
    document.querySelector('.popup-overlay').addEventListener('click', function(event) {
        if (event.target === this) {
            closeEditPopup();
            closeCreatePopup();
        }
    });
});

// Export functions to make them globally available
window.openEditPopup = openEditPopup;
window.closeEditPopup = closeEditPopup;
window.handleEditKeyPress = handleEditKeyPress;
window.saveDepartmentName = saveDepartmentName;
window.openCreatePopup = openCreatePopup;
window.closeCreatePopup = closeCreatePopup;
window.createDepartment = createDepartment; 