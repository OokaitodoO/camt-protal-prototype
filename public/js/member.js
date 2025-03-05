// Popup management
function openCreatePopup() {
    document.getElementById('createPopup').style.display = 'flex';
}

function closeCreatePopup() {
    document.getElementById('createPopup').style.display = 'none';
    document.querySelector('#createPopup form').reset();
    document.getElementById('createPreviewImage').src = '/images/default-avatar.png';
}

// Add this at the top of your file
let currentCard = null;

// Update the openEditPopup function
function openEditPopup(element) {
    // Debug log
    console.log('Opening edit popup for member');
    
    // Prevent default link behavior
    event.preventDefault();

    try {
        // Get data from data attributes
        const memberId = element.getAttribute('data-member-id');
        const firstName = element.getAttribute('data-first-name');
        const lastName = element.getAttribute('data-last-name');
        const position = element.getAttribute('data-position');
        const departmentId = element.getAttribute('data-department-id');

        console.log('Member data:', { memberId, firstName, lastName, position, departmentId });

        // Store current card for deletion reference
        currentCard = element.closest('.member-card');
        const profilePicture = currentCard.querySelector('img').src;

        // Set form values
        const form = document.getElementById('editForm');
        form.querySelector('#editMemberId').value = memberId;
        form.querySelector('#editFirstName').value = firstName;
        form.querySelector('#editLastName').value = lastName;
        form.querySelector('#editPosition').value = position;
        form.querySelector('#editDepartmentId').value = departmentId;
        document.getElementById('editPreviewImage').src = profilePicture;

        // Show the popup
        const popup = document.getElementById('editPopup');
        if (popup) {
            popup.style.display = 'flex';
            console.log('Popup displayed');
        } else {
            console.error('Edit popup element not found');
        }
    } catch (error) {
        console.error('Error in openEditPopup:', error);
    }
}

function closeEditPopup() {
    const popup = document.getElementById('editPopup');
    if (popup) {
        popup.style.display = 'none';
        // Reset form
        document.getElementById('editForm').reset();
    }
}

function openDeleteConfirmation() {
    console.log('Opening delete confirmation...');
    if (!currentCard) {
        console.error('No member selected for deletion');
        return;
    }

    const memberName = currentCard.querySelector('h3').textContent;
    const popup = document.getElementById('deletePopup');
    const nameSpan = document.getElementById('deleteMemberName');
    
    if (popup && nameSpan) {
        nameSpan.textContent = memberName;
        popup.style.display = 'flex';
    }
}

function closeDeletePopup() {
    document.getElementById('deletePopup').style.display = 'none';
}

// Image preview
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Member management
async function createMember(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    try {
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.textContent = 'กำลังสร้าง...';
        submitButton.disabled = true;

        const response = await axios.post('/members', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        if (response.data.success) {
            submitButton.textContent = 'สร้างสำเร็จ!';
            submitButton.style.backgroundColor = '#28a745';
            
            // Add new member card
            addMemberCard(response.data.member);
            
            // Reset form and close popup
            setTimeout(() => {
                form.reset();
                document.getElementById('createPreviewImage').src = '/images/default-avatar.png';
                closeCreatePopup();
                submitButton.textContent = 'สร้าง';
                submitButton.disabled = false;
                submitButton.style.backgroundColor = '#F48E2E';
            }, 1500);
        }
    } catch (error) {
        console.error('Error creating member:', error);
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.textContent = 'เกิดข้อผิดพลาด';
        submitButton.style.backgroundColor = '#dc3545';
        
        setTimeout(() => {
            submitButton.textContent = 'สร้าง';
            submitButton.style.backgroundColor = '#F48E2E';
            submitButton.disabled = false;
        }, 1500);
    }
}

async function updateMember(event) {
    event.preventDefault();
    const form = event.target;
    const memberId = document.getElementById('editMemberId').value;
    const formData = new FormData(form);
    formData.append('_method', 'PUT');

    try {
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.textContent = 'กำลังบันทึก...';
        submitButton.disabled = true;

        const response = await axios.post(`/members/${memberId}`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        if (response.data.success) {
            submitButton.textContent = 'บันทึกสำเร็จ!';
            submitButton.style.backgroundColor = '#28a745';
            
            // Update member card
            updateMemberCard(memberId, response.data.member);
            
            // Close popup after delay
            setTimeout(() => {
                closeEditPopup();
                submitButton.textContent = 'บันทึก';
                submitButton.disabled = false;
                submitButton.style.backgroundColor = '#F48E2E';
            }, 1500);
        }
    } catch (error) {
        console.error('Error updating member:', error);
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.textContent = 'เกิดข้อผิดพลาด';
        submitButton.style.backgroundColor = '#dc3545';
        
        setTimeout(() => {
            submitButton.textContent = 'บันทึก';
            submitButton.style.backgroundColor = '#F48E2E';
            submitButton.disabled = false;
        }, 1500);
    }
}

async function deleteMember() {
    if (!currentCard) {
        console.error('No member selected for deletion');
        return;
    }

    const memberId = document.getElementById('editMemberId').value;
    const deleteButton = document.querySelector('#deletePopup .btn-delete');
    
    try {
        deleteButton.textContent = 'กำลังลบ...';
        deleteButton.disabled = true;

        const response = await axios.delete(`/members/${memberId}`);

        if (response.data.success) {
            deleteButton.textContent = 'ลบสำเร็จ!';
            deleteButton.style.backgroundColor = '#28a745';
            
            // Add deleting animation
            currentCard.classList.add('deleting');
            
            setTimeout(() => {
                currentCard.remove();
                closeDeletePopup();
                closeEditPopup();
                currentCard = null;
                deleteButton.textContent = 'ลบ';
                deleteButton.disabled = false;
                deleteButton.style.backgroundColor = '#dc3545';
            }, 500);
        }
    } catch (error) {
        console.error('Error deleting member:', error);
        deleteButton.textContent = 'เกิดข้อผิดพลาด';
        setTimeout(() => {
            deleteButton.textContent = 'ลบ';
            deleteButton.disabled = false;
        }, 1500);
    }
}

// Helper functions
function addMemberCard(memberData) {
    const container = document.querySelector('.content-container');
    const newCard = document.createElement('div');
    newCard.className = 'member-card new';
    
    newCard.innerHTML = `
        <div class="card-edit">
            <span>
                <a href="#" class="icon-action" onclick="openEditPopup(this)" data-member-id="${memberData.id}">
                    <i class="fas fa-edit"></i> แก้ไข
                </a>
            </span>
        </div>
        <div class="card-content">
            <img src="${memberData.profile_picture || '/images/default-avatar.png'}" alt="Profile Picture" class="profile-picture">
            <h3>${memberData.first_name} ${memberData.last_name}</h3>
            <p>ตำแหน่ง: ${memberData.position}</p>
            <p>หน่วยงาน: ${memberData.department_name}</p>
        </div>
    `;
    
    // Insert before the create card
    const createCard = container.querySelector('.create-card');
    container.insertBefore(newCard, createCard);
}

function updateMemberCard(memberId, memberData) {
    const card = document.querySelector(`[data-member-id="${memberId}"]`).closest('.member-card');
    
    card.innerHTML = `
        <div class="card-edit">
            <span>
                <a href="#" class="icon-action" onclick="openEditPopup(this)" data-member-id="${memberData.id}">
                    <i class="fas fa-edit"></i> แก้ไข
                </a>
            </span>
        </div>
        <div class="card-content">
            <img src="${memberData.profile_picture || '/images/default-avatar.png'}" alt="Profile Picture" class="profile-picture">
            <h3>${memberData.first_name} ${memberData.last_name}</h3>
            <p>ตำแหน่ง: ${memberData.position}</p>
            <p>หน่วยงาน: ${memberData.department_name}</p>
        </div>
    `;
    
    card.classList.add('updated');
    setTimeout(() => card.classList.remove('updated'), 300);
}

// Search functionality
function searchMembers() {
    const searchInput = document.querySelector('.serach-bar input[type="text"]');
    const searchTerm = searchInput.value.toLowerCase();
    const cards = document.querySelectorAll('.member-card:not(.create-card)');
    
    cards.forEach(card => {
        const memberName = card.querySelector('h3').textContent.toLowerCase();
        const position = card.querySelector('p').textContent.toLowerCase();
        const department = card.querySelectorAll('p')[1].textContent.toLowerCase();
        
        if (memberName.includes(searchTerm) || 
            position.includes(searchTerm) || 
            department.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

// Update the event listeners
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, setting up member listeners');

    // Add click handlers for edit buttons
    document.querySelectorAll('.icon-action[onclick="openEditPopup(this)"]').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            openEditPopup(this);
        });
    });

    // Close popup when clicking outside
    document.querySelectorAll('.popup-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(event) {
            if (event.target === this) {
                if (this.id === 'editPopup') {
                    closeEditPopup();
                } else if (this.id === 'deletePopup') {
                    closeDeletePopup();
                } else if (this.id === 'createPopup') {
                    closeCreatePopup();
                }
            }
        });
    });

    // Close buttons in popups
    document.querySelectorAll('.popup-close').forEach(button => {
        button.addEventListener('click', function() {
            const popup = this.closest('.popup-overlay');
            if (popup.id === 'editPopup') {
                closeEditPopup();
            } else if (popup.id === 'deletePopup') {
                closeDeletePopup();
            } else if (popup.id === 'createPopup') {
                closeCreatePopup();
            }
        });
    });

    // Search input event listener
    const searchInput = document.querySelector('.serach-bar input[type="text"]');
    if (searchInput) {
        searchInput.addEventListener('input', searchMembers);
    }

    // Add animations for cards
    document.querySelectorAll('.member-card').forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Debug: Log if script is properly loaded
    console.log('Member.js initialized');
});

// Add these CSS animations
const style = document.createElement('style');
style.textContent = `
    .deleting {
        animation: fadeOut 0.3s ease-out forwards;
    }

    @keyframes fadeOut {
        from { 
            opacity: 1;
            transform: scale(1);
        }
        to { 
            opacity: 0;
            transform: scale(0.8);
        }
    }

    .member-card {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);

// Make sure functions are available globally
window.openEditPopup = openEditPopup;
window.closeEditPopup = closeEditPopup;
window.openDeleteConfirmation = openDeleteConfirmation;
window.closeDeletePopup = closeDeletePopup;
window.deleteMember = deleteMember;
window.createMember = createMember;
window.updateMember = updateMember;
window.previewImage = previewImage; 