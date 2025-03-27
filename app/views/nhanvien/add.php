<h1>Thêm nhân viên mới</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/KT/KT_Php/save" onsubmit="return validateForm();">
    <div class="form-group">
        <label for="ma_nv">Mã nhân viên:</label>
        <input type="text" id="ma_nv" name="ma_nv" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="ten_nv">Tên nhân viên:</label>
        <input type="text" id="ten_nv" name="ten_nv" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="phai">Giới tính:</label>
        <select id="phai" name="phai" class="form-control" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>

    <div class="form-group">
        <label for="noi_sinh">Nơi sinh:</label>
        <input type="text" id="noi_sinh" name="noi_sinh" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="ma_phong">Phòng ban:</label>
        <select id="ma_phong" name="ma_phong" class="form-control" required>
            <?php foreach ($departments as $dept): ?>
                <option value="<?php echo $dept->Ma_Phong; ?>">
                    <?php echo htmlspecialchars($dept->Ten_Phong, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="luong">Lương:</label>
        <input type="number" id="luong" name="luong" class="form-control" step="0.01" required>
    </div>

    <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
    <a href="/KT/KT_Php" class="btn btn-secondary mt-2">Quay lại danh sách</a>
</form>