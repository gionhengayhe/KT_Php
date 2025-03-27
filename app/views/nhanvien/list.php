<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <strong>Xin chào, <?= $_SESSION['user']['fullname'] ?? 'User' ?>!</strong>
        <a href="/KT/KT_Php/logout" class="btn btn-outline-danger">Đăng xuất</a>
    </div>

    <h2 class="text-center">Thông Tin Nhân Viên</h2>
    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <a href="/KT/KT_Php/add" class="btn btn-primary mb-3">Thêm nhân viên</a>
    <?php endif; ?>
    <table class="table table-bordered table-hover text-center">
        <thead class="table-light">
            <tr>
                <th>Mã Nhân Viên</th>
                <th>Tên Nhân Viên</th>
                <th>Giới Tính</th>
                <th>Nơi Sinh</th>
                <th>Tên Phòng</th>
                <th>Lương</th>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <th>Hành động</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nhanviens as $nv): ?>
                <tr>
                    <td><?= htmlspecialchars($nv['Ma_NV']) ?></td>
                    <td><?= htmlspecialchars($nv['Ten_NV']) ?></td>
                    <td>
                        <img src="app/views/<?= ($nv['Phai'] == 'NAM') ? 'man.png' : 'woman.png' ?>" alt="Giới tính" width="30" height="30">
                    </td>
                    <td><?= htmlspecialchars($nv['Noi_Sinh']) ?></td>
                    <td><?= htmlspecialchars($nv['Ten_Phong']) ?></td>
                    <td><?= htmlspecialchars($nv['Luong']) ?></td>
                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <td>
                            <a href="/KT/KT_Php/edit/<?= $nv['Ma_NV'] ?>" class="btn btn-success btn-sm">Sửa</a>
                            <a href="/KT/KT_Php/delete/<?= $nv['Ma_NV'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item"><a class="page-link" href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>?page=<?= $i ?>">Trang <?= $i ?></a></li>
            <?php endfor; ?>
        </ul>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>