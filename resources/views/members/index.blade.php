<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มบุคลากร</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/department.css') }}">
    <link rel="stylesheet" href="{{ asset('css/member.css') }}">
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
                <li><a href="{{ route('departments.index') }}" class="btn">หน่วยงาน</a></li>
                <li><a href="{{ route('members.index') }}" class="btn">เพิ่มบุคลากร</a></li>
                <li><a href="" class="btn">ภาระงาน</a></li>
            </ul>
        </nav>
        <div class="serach-bar">
            <div class="title">
                <h1><i class="fas fa-user-plus"></i> เพิ่มบุคลากร</h1>
            </div>
            <div class="action-container">
                <input type="text" placeholder="ค้นหาบุคลากร...">
                <button type="button" class="btn-orange create-btn" onclick="openCreatePopup()">
                    <i class="fas fa-plus"></i> เพิ่มบุคลากร
                </button>
            </div>
        </div>
    </header>

    <!-- Content -->
    <section class="content-container">
        @foreach($members as $member)
        <div class="member-card">
            <div class="card-edit">
                <span>
                    <a href="#" class="icon-action" onclick="openEditPopup(this)" data-member-id="{{ $member->id }}">
                        <i class="fas fa-edit"></i> แก้ไข
                    </a>
                </span>
            </div>
            <div class="card-content">
                <img src="{{ $member->profile_picture ? asset('storage/' . $member->profile_picture) : asset('images/default-avatar.png') }}" 
                     alt="Profile Picture" class="profile-picture">
                <h3>{{ $member->first_name }} {{ $member->last_name }}</h3>
                <p>ตำแหน่ง: {{ $member->position }}</p>
                <p>หน่วยงาน: {{ $member->department->name }}</p>
            </div>
        </div>
        @endforeach

        <!-- Create New Card -->
        <div class="member-card create-card" onclick="openCreatePopup()">
            <div class="card-content">
                <span><i class="fas fa-plus-circle fa-3x"></i></span>
                <p>เพิ่มบุคลากร</p>
            </div>
        </div>
    </section>

    <!-- Create Member Popup -->
    <div class="popup-overlay" id="createPopup">
        <div class="popup-content">
            <div class="popup-header">
                <h2>เพิ่มบุคลากรใหม่</h2>
                <span class="popup-close" onclick="closeCreatePopup()">&times;</span>
            </div>
            <form class="popup-form" onsubmit="createMember(event)">
                <div class="image-upload-container">
                    <img id="createPreviewImage" class="preview-image" src="{{ asset('images/default-avatar.png') }}" alt="Profile Picture">
                    <input type="file" id="createProfilePicture" name="profile_picture" accept="image/*" onchange="previewImage(this, 'createPreviewImage')" class="image-input">
                    <label for="createProfilePicture" class="upload-label">
                        <i class="fas fa-upload"></i> อัพโหลดรูปภาพ
                    </label>
                </div>
                <input type="text" name="first_name" placeholder="ชื่อ" required>
                <input type="text" name="last_name" placeholder="นามสกุล" required>
                <select name="position" required>
                    <option value="">เลือกตำแหน่ง</option>
                    <option value="professor">อาจารย์</option>
                    <option value="staff">เจ้าหน้าที่</option>
                </select>
                <select name="department_id" required>
                    <option value="">เลือกหน่วยงาน</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-save">สร้าง</button>
            </form>
        </div>
    </div>

    @vite(['resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/member.js') }}"></script>
</body>
</html> 