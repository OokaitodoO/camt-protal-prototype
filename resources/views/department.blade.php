<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>

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
                <li><a href="#" class="btn">หน่วยงาน</a></li>
                <li><a href="#" class="btn">เพิ่มบุคลากร</a></li>
                <li><a href="#" class="btn">ภาระงาน</a></li>
            </ul>
        </nav>
        <div class="serach-bar">
            <div class="title">
                <h1><i class="fas fa-building"></i> หน่วยงาน</h1>
            </div>
            <div class="action-container">
                <input type="text" placeholder="ค้นหาหน่วยงาน...">
                <button type="button" class="btn-orange create-btn" onclick="openCreatePopup()">
                    <i class="fas fa-plus"></i> เพิ่มหน่วยงาน
                </button>
            </div>
        </div>
    </header>

    <!-- Content -->
    <section class="content-container">
        <div class="department-card">
            <div class="card-edit">
                <span><a href="#" class="icon-action" onclick="openEditPopup(this)" data-department="หน่วยงาน"><i class="fas fa-edit"></i> แก้ไข</a></span>
            </div>
            <div class="card-content">
                <span><i class="fas fa-building fa-3x"></i></span>
                <p class="department-name">หน่วยงาน</p>
            </div>
        </div>
        <div class="department-card">
            <div class="card-edit">
                <span><a href="#" class="icon-action" onclick="openEditPopup(this)" data-department="หน่วยงาน"><i class="fas fa-edit"></i> แก้ไข</a></span>
            </div>
            <div class="card-content">
                <span><i class="fas fa-building fa-3x"></i></span>
                <p class="department-name">หน่วยงาน</p>
            </div>
        </div>
        <div class="department-card">
            <div class="card-edit">
                <span><a href="#" class="icon-action" onclick="openEditPopup(this)" data-department="หน่วยงาน"><i class="fas fa-edit"></i> แก้ไข</a></span>
            </div>
            <div class="card-content">
                <span><i class="fas fa-building fa-3x"></i></span>
                <p class="department-name">หน่วยงาน</p>
            </div>
        </div>
    </section>

    <!-- Edit Popup -->
    <div class="popup-overlay" id="editPopup">
        <div class="popup-content">
            <div class="popup-header">
                <h2>แก้ไขชื่อหน่วยงาน</h2>
                <span class="popup-close" onclick="closeEditPopup()">&times;</span>
            </div>
            <form class="popup-form" id="editForm" onsubmit="saveDepartmentName(event)">
                <input type="text" id="departmentName" placeholder="ชื่อหน่วยงาน">
                <button type="submit" class="btn-orange">บันทึก</button>
            </form>
        </div>
    </div>

    <!-- Add this new popup for creating department -->
    <div class="popup-overlay" id="createPopup">
        <div class="popup-content">
            <div class="popup-header">
                <h2>เพิ่มหน่วยงานใหม่</h2>
                <span class="popup-close" onclick="closeCreatePopup()">&times;</span>
            </div>
            <form class="popup-form" onsubmit="createDepartment(event)">
                <input type="text" id="newDepartmentName" placeholder="ชื่อหน่วยงาน">
                <button type="submit" class="btn-orange">สร้าง</button>
            </form>
        </div>
    </div>

    <!-- Add your compiled JS -->
    @vite(['resources/js/app.js'])
</body>
</html>