<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน่วยงาน</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/department.css') }}">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="role-container">
            <ul>
                <li><a href="" class="btn-orange">ตำแหน่ง</a></li>
            </ul>
        </div>
        <nav class="nav-bar">
            <span class="camt-logo">Logo Camt</span>
            <ul class="nav-action">
                <li><a href="{{route('departments.index')}}" class="btn active">หน่วยงาน</a></li>
                <li><a href="{{ route('members.index') }}" class="btn">เพิ่มบุคลากร</a></li>
                <li><a href="{{ route('tasks.index') }}" class="btn">ภาระงาน</a></li>
            </ul>
        </nav>
        <div class="serach-bar">
            <div class="title">
                <h1><i class="fas"></i> หน่วยงาน</h1>
            </div>
            <div class="action-container">
                <button type="button" class="btn-orange create-nav-btn" onclick="openCreatePopup()">
                    <i class="fas fa-plus"></i> เพิ่มหน่วยงาน
                </button>
                <input type="text" placeholder="ค้นหาหน่วยงาน...">
            </div>
        </div>
    </header>

    <!-- Content -->
    <section class="content-container">
        <!-- Regular department cards -->
        @php
            $sortedDepartments = $departments->sortBy('name');
        @endphp
        
        @foreach($sortedDepartments as $department)
        <div class="department-card">
            <div class="card-edit">
                <span>
                    <a href="#" class="icon-action" onclick="openEditPopup(this)" data-department="{{ $department->name }}">
                        <i class="fas fa-edit"></i> แก้ไข
                    </a>
                </span>
            </div>
            <div class="card-content">
                <span><i class="fas fa-building fa-3x"></i></span>
                <p class="department-name">{{ $department->name }}</p>
            </div>
        </div>
        @endforeach

        <!-- Create New Card (Always at the end) -->
        <div class="department-card create-card" onclick="openCreatePopup()">
            <div class="card-content">
                <span><i class="fas fa-plus-circle fa-3x"></i></span>
                <p>เพิ่มหน่วยงาน</p>
            </div>
        </div>
    </section>

    <!-- Edit Popup -->
    <div class="popup-overlay" id="editPopup">
        <div class="popup-content">
            <div class="popup-header">
                <h2>แก้ไขหน่วยงาน</h2>
                <span class="popup-close" onclick="closeEditPopup()">&times;</span>
            </div>
            <form class="popup-form" id="editForm" onsubmit="saveDepartmentName(event)">
                <div class="image-upload-container">
                    <img id="editPreviewImage" class="preview-image" src="" alt="Department Icon">
                    <input type="file" id="editDepartmentIcon" accept="image/*" onchange="previewImage(this, 'editPreviewImage')" class="image-input">
                    <label for="editDepartmentIcon" class="upload-label">
                        <i class="fas fa-upload"></i> อัพโหลดไอคอน
                    </label>
                    <p class="image-requirements">ขนาดไฟล์สูงสุด: 2MB, ขนาดแนะนำ: 128x128px</p>
                </div>
                <input type="text" id="departmentName" placeholder="ชื่อหน่วยงาน">
                <div class="button-group">
                    <button type="submit" class="btn-save">บันทึก</button>
                    <button type="button" class="btn-delete" onclick="openDeleteConfirmation()">
                        <i class="fas fa-trash"></i> ลบหน่วยงาน
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Create Popup -->
    <div class="popup-overlay" id="createPopup">
        <div class="popup-content">
            <div class="popup-header">
                <h2>เพิ่มหน่วยงานใหม่</h2>
                <span class="popup-close" onclick="closeCreatePopup()">&times;</span>
            </div>
            <form class="popup-form" onsubmit="createDepartment(event)">
                <div class="image-upload-container">
                    <img id="createPreviewImage" class="preview-image" src="{{ asset('images/default-department.png') }}" alt="Department Icon">
                    <input type="file" id="createDepartmentIcon" accept="image/*" onchange="previewImage(this, 'createPreviewImage')" class="image-input">
                    <label for="createDepartmentIcon" class="upload-label">
                        <i class="fas fa-upload"></i> อัพโหลดไอคอน
                    </label>
                    <p class="image-requirements">ขนาดไฟล์สูงสุด: 2MB, ขนาดแนะนำ: 128x128px</p>
                </div>
                <input type="text" id="newDepartmentName" placeholder="ชื่อหน่วยงาน">
                <button type="submit" class="btn-save">สร้าง</button>
            </form>
        </div>
    </div>

    <!-- Delete confirmation popup -->
    <div class="popup-overlay" id="deletePopup">
        <div class="popup-content">
            <div class="popup-header">
                <h2>ยืนยันการลบหน่วยงาน</h2>
                <span class="popup-close" onclick="closeDeletePopup()">&times;</span>
            </div>
            <div class="popup-form">
                <p>คุณต้องการลบหน่วยงาน "<span id="deleteDepartmentName"></span>" ใช่หรือไม่?</p>
                <div class="button-group">
                    <button type="button" class="btn-cancel" onclick="closeDeletePopup()">ยกเลิก</button>
                    <button type="button" class="btn-delete" onclick="deleteDepartment()">ลบ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add your compiled JS -->
    @vite(['resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/department.js') }}"></script>
</body>
</html>