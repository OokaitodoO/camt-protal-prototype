console.log('Task JS loaded');

function openEditPopup(taskId) {
    const popup = document.getElementById('editPopup');
    popup.innerHTML = `
        <div class="popup-content">
            <div class="popup-header">
                <h2>แก้ไขภาระงาน</h2>
                <span class="popup-close" onclick="closeEditPopup()">&times;</span>
            </div>
            <form class="popup-form" onsubmit="saveTask(event, ${taskId})">
                <div class="form-group">
                    <label>ชื่อภาระงาน</label>
                    <input type="text" id="taskName" required>
                </div>
                <div class="form-group">
                    <label>ผู้รับผิดชอบ</label>
                    <select id="assignee" required>
                        <option value="">เลือกผู้รับผิดชอบ</option>
                        <!-- Add options dynamically -->
                    </select>
                </div>
                <div class="form-group">
                    <label>กำหนดส่ง</label>
                    <input type="date" id="deadline" required>
                </div>
                <div class="form-group">
                    <label>งานย่อย</label>
                    <div id="subtasks">
                        <!-- Subtasks will be added here -->
                    </div>
                    <button type="button" onclick="addSubtask()" class="btn-add-subtask">
                        <i class="fas fa-plus"></i> เพิ่มงานย่อย
                    </button>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn-save">บันทึก</button>
                    <button type="button" class="btn-delete" onclick="deleteTask(${taskId})">
                        <i class="fas fa-trash"></i> ลบภาระงาน
                    </button>
                </div>
            </form>
        </div>
    `;
    popup.style.display = 'flex';
}

function closeEditPopup() {
    const popup = document.getElementById('editPopup');
    popup.style.display = 'none';
}

function addSubtask() {
    const subtasksDiv = document.getElementById('subtasks');
    const subtaskInput = document.createElement('div');
    subtaskInput.className = 'subtask-input';
    subtaskInput.innerHTML = `
        <input type="text" placeholder="ชื่องานย่อย">
        <button type="button" onclick="removeSubtask(this)" class="btn-remove-subtask">
            <i class="fas fa-times"></i>
        </button>
    `;
    subtasksDiv.appendChild(subtaskInput);
}

function removeSubtask(button) {
    button.parentElement.remove();
}

function saveTask(event, taskId) {
    event.preventDefault();
    // Add your save logic here
    closeEditPopup();
}

function deleteTask(taskId) {
    if (confirm('คุณต้องการลบภาระงานนี้ใช่หรือไม่?')) {
        // Add your delete logic here
        closeEditPopup();
    }
}

// Initialize when document is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('Task page initialized');
});