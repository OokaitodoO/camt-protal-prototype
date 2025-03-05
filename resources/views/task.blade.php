<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ภาระงาน</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/task.css') }}">
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
                <li><a href="{{route('departments.index')}}" class="btn">หน่วยงาน</a></li>
                <li><a href="{{ route('members.index') }}" class="btn">เพิ่มบุคลากร</a></li>
                <li><a href="{{ route('tasks.index') }}" class="btn active">ภาระงาน</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <div class="title">
                <h1><i class="fas"></i> ภาระงาน</h1>
            </div>
            <div class="action-container">
                <input type="text" placeholder="ค้นหาภาระงาน...">
                <!-- <button type="button" class="btn-orange create-btn" onclick="openCreatePopup()">
                    <i class="fas fa-plus"></i> เพิ่มภาระงาน
                </button> -->
            </div>
        </div>
    </header>

    <!-- Content -->
    <section class="content-container">
        <table class="task-table">
            <thead>
                <tr>
                    <th>ภาระงาน</th>
                    <th>ผู้สร้าง</th>
                    <th>ผู้รับผิดชอบ</th>
                    <th>หน่วยงาน</th>
                    <th>กำหนดส่ง</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Task 1 -->
                <tr>
                    <td>
                        <div class="task-details">
                            <h4>จัดทำรายงานประจำปี</h4>
                            <ul class="subtasks">
                                <li>รวบรวมข้อมูล</li>
                                <li>วิเคราะห์ผล</li>
                                <li>สรุปรายงาน</li>
                            </ul>
                        </div>
                    </td>
                    <td>สมชาย ใจดี</td>
                    <td>สมหญิง รักงาน</td>
                    <td>ฝ่ายบริหาร</td>
                    <td>31 มี.ค. 2567</td>
                    <td>
                        <button class="edit-btn" onclick="openEditPopup(1)">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <!-- Sample Task 2 -->
                <tr>
                    <td>
                        <div class="task-details">
                            <h4>พัฒนาระบบใหม่</h4>
                            <ul class="subtasks">
                                <li>ออกแบบระบบ</li>
                                <li>พัฒนาโค้ด</li>
                                <li>ทดสอบระบบ</li>
                            </ul>
                        </div>
                    </td>
                    <td>วิชัย เก่งกาจ</td>
                    <td>มานี คนเก่ง</td>
                    <td>ฝ่ายไอที</td>
                    <td>15 เม.ย. 2567</td>
                    <td>
                        <button class="edit-btn" onclick="openEditPopup(2)">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <!-- Sample Task 3 -->
                <tr>
                    <td>
                        <div class="task-details">
                            <h4>จัดอบรมพนักงาน</h4>
                            <ul class="subtasks">
                                <li>เตรียมเอกสาร</li>
                                <li>จองห้องประชุม</li>
                                <li>ประสานวิทยากร</li>
                            </ul>
                        </div>
                    </td>
                    <td>สุดา มั่นคง</td>
                    <td>ประเสริฐ ตั้งใจ</td>
                    <td>ฝ่ายบุคคล</td>
                    <td>1 พ.ค. 2567</td>
                    <td>
                        <button class="edit-btn" onclick="openEditPopup(3)">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Edit Task Popup -->
    <div class="popup-overlay" id="editPopup">
        <!-- Popup content will be added by JavaScript -->
    </div>

    <!-- Add your compiled JS -->
    @vite(['resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/task.js') }}"></script>
</body>
</html>