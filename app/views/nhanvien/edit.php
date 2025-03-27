<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa nhân viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h1 class="text-center">Chỉnh sửa nhân viên</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="/KT/KT_Php/update/<?php echo $nhanVien->Ma_NV; ?>" class="needs-validation" novalidate>
        <input type="hidden" name="ma_nv" value="<?php echo $nhanVien->Ma_NV; ?>">

        <div class="mb-3">
            <label for="ten_nv" class="form-label">Tên nhân viên:</label>
            <input type="text" id="ten_nv" name="ten_nv" class="form-control" value="<?php echo isset($nhanVien->Ten_NV) ? htmlspecialchars($nhanVien->Ten_NV, ENT_QUOTES, 'UTF-8') : ''; ?>" required>
            <div class="invalid-feedback">Vui lòng nhập tên nhân viên.</div>
        </div>

        <div class="mb-3">
            <label for="phai" class="form-label">Giới tính:</label>
            <select id="phai" name="phai" class="form-select" required>
                <option value="NAM" <?php echo ($nhanVien->Phai == "NAM") ? "selected" : ""; ?>>Nam</option>
                <option value="NU" <?php echo ($nhanVien->Phai == "NU") ? "selected" : ""; ?>>Nữ</option>
            </select>
            <div class="invalid-feedback">Vui lòng chọn giới tính.</div>
        </div>

        <div class="mb-3">
            <label for="noi_sinh" class="form-label">Nơi sinh:</label>
            <input type="text" id="noi_sinh" name="noi_sinh" class="form-control" value="<?php echo htmlspecialchars($nhanVien->Noi_Sinh, ENT_QUOTES, 'UTF-8'); ?>" required>
            <div class="invalid-feedback">Vui lòng nhập nơi sinh.</div>
        </div>

        <div class="mb-3">
            <label for="ma_phong" class="form-label">Phòng ban:</label>
            <select id="ma_phong" name="ma_phong" class="form-select" required>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?php echo $dept->Ma_Phong; ?>" <?php echo ($nhanVien->Ma_Phong == $dept->Ma_Phong) ? "selected" : ""; ?>>
                        <?php echo htmlspecialchars($dept->Ten_Phong, ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Vui lòng chọn phòng ban.</div>
        </div>

        <div class="mb-3">
            <label for="luong" class="form-label">Lương:</label>
            <input type="number" id="luong" name="luong" class="form-control" value="<?php echo $nhanVien->Luong; ?>" step="0.01" required>
            <div class="invalid-feedback">Vui lòng nhập lương hợp lệ.</div>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="/KT/KT_Php" class="btn btn-secondary mt-2">Quay lại danh sách</a>
    </form>

    <script>
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>