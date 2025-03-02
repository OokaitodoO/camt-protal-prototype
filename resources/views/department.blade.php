<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/department.css') }}">
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
                <h1>หน่วยงาน</h1>
            </div>
            <div>
                <input type="text">
            </div>
        </div>
    </header>

    <!-- Content -->
    <section class="content-container">
        <div class="department-card">
            <div class="card-edit">
                <span><a href="#" class="icon-action">แก้ไข</a></span>
            </div>
            <div class="card-content">
                <span>Department icon</span>
                <p>หน่วยงาน</p>
            </div>
        </div>
        <div class="department-card">
            <div class="card-edit">
                <span><a href="#" class="icon-action">แก้ไข</a></span>
            </div>
            <div class="card-content">
                <span>Department icon</span>
                <p>หน่วยงาน</p>
            </div>
        </div>
        <div class="department-card">
            <div class="card-edit">
                <span><a href="#" class="icon-action">แก้ไข</a></span>
            </div>
            <div class="card-content">
                <span>Department icon</span>
                <p>หน่วยงาน</p>
            </div>
        </div>
    </section>
</body>
</html>