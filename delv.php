<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تتبع الطلبات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            font-family: 'Cairo', sans-serif;
            background: #f5f7fa;
        }
        h2, h3, h4, h5, h6 { font-weight: 700; }
        h1 { font-size: 1.5rem; }
        label, th, td, span, div, p { font-size: 1rem; }
        #user-card, #stats .stat-card, #orders-table {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px #0001;
            transition: background-color 0.3s ease;
        }
        #user-card:hover, #stats .stat-card:hover, #orders-table:hover {
            background-color: #e9ecef;
        }
        #orders-table table tbody tr td {
            transition: background-color 0.3s ease;
        }
        #orders-table table tbody tr:hover {
            background-color: #f0f0f0;
        }
        #user-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        #user-card .icon {
            background: #4f8cff;
            color: #fff;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.5rem;
        }
        #user-card .info { flex: 1; }
        #stats { margin-bottom: 1.5rem; }
        #stats .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
            color: #4f8cff;
        }
        #orders-table .badge { font-size: 0.95em; }
        #orders-table .btn-link {
            color: #4f8cff;
            text-decoration: none;
        }
        @media (max-width: 767px) {
            #user-card { flex-direction: column; align-items: flex-start; }
            #stats .row > div { margin-bottom: 1rem; }
            #orders-table { padding: 0.5rem; }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- User Card -->
       <?php

$stmt = $conn->prepare('SELECT * FROM dr WHERE id=1');
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
?>
            <div id="user-card">
                <div class="icon">
                    <span class="bi bi-person"></span>
                </div>
                <div class="info">
                    <div class="fw-bold"><?php echo $row['name']; ?></div>
                    <div class="text-muted" style="font-size:0.95em;">رقم المنفذ: <?php echo $row['id']; ?></div>
                </div>
                <div class="ms-auto text-end">
                    <div class="fw-bold text-primary" style="font-size:1.1em;">نظام تتبع الطلبات</div>
                    <div class="text-muted" style="font-size:0.95em;">لوحة تحكم المنفذ</div>
                </div>
            </div>
        <?php } 
        $stmt->close();

    
        
     // إجمالي الطلبات
$stmt = $conn->prepare('SELECT COUNT(*) FROM code');
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_row();
$total = $row[0];

// الطلبات المعلقة
$stmt = $conn->prepare('SELECT COUNT(*) FROM code WHERE actv=0');
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_row();
$pending = $row[0];

// الطلبات قيد التنفيذ
$stmt = $conn->prepare('SELECT COUNT(*) FROM code WHERE actv=1');
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_row();
$in_progress = $row[0];

// الطلبات تم التوصيل
$stmt = $conn->prepare('SELECT COUNT(*) FROM code WHERE actv=2');
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_row();
$delivered = $row[0];
$a = 0; $b = 0; $c = 0; $i = 0;
?>


        <div id="stats" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4 col-12">
                    <div class="stat-card">
                        <div class="text-muted mb-1">طلبات اليوم</div>
                        <div class="value"><?php echo $i; ?></div>
                        <div class="text-muted" style="font-size:0.95em;">
                            <?php echo $a; ?> معلقة  | <?php echo $b; ?> قيد التنفيذ  | <?php echo $c; ?> تم التوصيل
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="stat-card">
                        <div class="text-muted mb-1">المسافة المقطوعة</div>
                        <div class="value">42 <span style="font-size:1rem;">كم</span></div>
                        <div class="text-muted" style="font-size:0.95em;">اليوم</div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="stat-card">
                        <div class="text-muted mb-1">متوسط وقت التوصيل</div>
                        <div class="value">28 <span style="font-size:1rem;">دقيقة</span></div>
                        <div class="text-muted" style="font-size:0.95em;">اليوم</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div id="orders-table">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-bold" style="font-size:1.1em;">الطلبات المخصصة لك</div>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" style="width:auto;">
                        <option>جميع الطلبات</option>
                    </select>
                    <button class="btn btn-primary btn-sm">تحديث</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>رقم الطلب</th>
                            <th>العميل</th>
                            <th>العنوان</th>
                            <th>الوقت</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>

              <?php
$stmt = $conn->prepare('SELECT * FROM requests');
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $id_name = $row['id_users'];
    $id_code = $row['code'];

    // جلب اسم المستخدم
    $stmt_user = $conn->prepare('SELECT name FROM users WHERE id=?');
    $stmt_user->bind_param('i', $id_name);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $user_name = ($user_row = $result_user->fetch_assoc()) ? $user_row['name'] : 'غير معروف';
    $stmt_user->close();

    // جلب بيانات code
    $map = '';
    $act = 0;
    $stmt_code = $conn->prepare('SELECT map, actv FROM code WHERE code=?');
    $stmt_code->bind_param('s', $id_code);
    $stmt_code->execute();
    $result_code = $stmt_code->get_result();
    if ($code_row = $result_code->fetch_assoc()) {
        $map = $code_row['map'];
        $act = $code_row['actv'];
    }
    $stmt_code->close();
?>
    <tr>
        <td><a href="index2.php" class="btn-link"><?php echo $row['code']; ?></a></td>
        <td><?php echo $user_name; ?></td>
        <td><a href="<?php echo $map; ?>"><span class="badge bg-warning text-dark">عرض</span></a></td>
        <td><?php echo $row['date']; ?></td>
        <td>
            <?php
            if ($act == 0) {
                echo '<span class="badge bg-warning text-dark">معلق</span>';
            } elseif ($act == 1) {
                echo '<span class="badge bg-success">جاري التوصيل</span>';
            } elseif ($act == 2) {
                echo '<span class="badge" style="background-color: #0d6efd;">مكتمل</span>';
            } elseif ($act == 3) {
                echo '<span class="badge bg-danger">ملغي</span>';
            } else {
                echo '<span class="badge bg-secondary">غير معروف</span>';
            }
            ?>
        </td>
    </tr>



                            <td><a href="#" class="btn-link">عرض التفاصيل</a></td>
                        </tr>
                        <?php } ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>