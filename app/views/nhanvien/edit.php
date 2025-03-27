<h1>Chỉnh sửa nhân viên</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/KT/KT_Php/update/<?php echo $nhanVien->Ma_NV; ?>">
    <input type="hidden" name="ma_nv" value="<?php echo $nhanVien->Ma_NV; ?>">

    <div class="form-group">
        <label for="ten_nv">Tên nhân viên:</label>
        <input type="text" id="ten_nv" name="ten_nv" class="form-control" value="<?php echo isset($nhanVien->Ten_NV) ? htmlspecialchars($nhanVien->Ten_NV, ENT_QUOTES, 'UTF-8') : ''; ?>" required>


    </div>

    <div class="form-group">
        <label for="phai">Giới tính:</label>
        <select id="phai" name="phai" class="form-control" required>
            <option value="NAM" <?php echo ($nhanVien->Phai == "NAM") ? "selected" : ""; ?>>Nam</option>
            <option value="NU" <?php echo ($nhanVien->Phai == "NU") ? "selected" : ""; ?>>Nữ</option>
        </select>
    </div>

    <div class="form-group">
        <label for="noi_sinh">Nơi sinh:</label>
        <input type="text" id="noi_sinh" name="noi_sinh" class="form-control" value="<?php echo htmlspecialchars($nhanVien->Noi_Sinh, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label for="ma_phong">Phòng ban:</label>
        <select id="ma_phong" name="ma_phong" class="form-control" required>
            <?php foreach ($departments as $dept): ?>
                <option value="<?php echo $dept->Ma_Phong; ?>" <?php echo ($nhanVien->Ma_Phong == $dept->Ma_Phong) ? "selected" : ""; ?>>
                    <?php echo htmlspecialchars($dept->Ten_Phong, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="luong">Lương:</label>
        <input type="number" id="luong" name="luong" class="form-control" value="<?php echo $nhanVien->Luong; ?>" step="0.01" required>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="/KT/KT_Php" class="btn btn-secondary mt-2">Quay lại danh sách</a>
</form>