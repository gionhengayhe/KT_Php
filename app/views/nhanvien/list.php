<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Nhân Viên</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 30px;
            height: 30px;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid black;
            margin: 2px;
        }

        .logout {
            text-align: right;
            margin-bottom: 10px;
        }

        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid black;
            margin: 2px;
            display: inline-block;
        }

        .btn-danger {
            color: white;
            background-color: red;
        }

        .btn-edit {
            color: white;
            background-color: green;
        }
    </style>
</head>

<body>
    <div class="logout">
        <strong>Xin chào, <?= $_SESSION['user']['fullname'] ?? 'User' ?>!</strong>
        <a href="/KT/KT_Php/logout" class="btn">Đăng xuất</a>
    </div>

    <h2>Thông Tin Nhân Viên</h2>
    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <a href="/KT/KT_Php/add" class="btn btn-add">Thêm nhân viên</a>
    <?php endif; ?>
    <table>
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
        <?php foreach ($nhanviens as $nv): ?>
            <tr>
                <td><?= htmlspecialchars($nv['Ma_NV']) ?></td>
                <td><?= htmlspecialchars($nv['Ten_NV']) ?></td>
                <td>
                    <img src="app/views/<?= ($nv['Phai'] == 'NAM') ? 'man.png' : 'woman.png' ?>" alt="Giới tính">
                </td>
                <td><?= htmlspecialchars($nv['Noi_Sinh']) ?></td>
                <td><?= htmlspecialchars($nv['Ten_Phong']) ?></td>
                <td><?= htmlspecialchars($nv['Luong']) ?></td>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <td>
                        <a href="/KT/KT_Php/edit/<?= $nv['Ma_NV'] ?>" class="btn btn-edit">Sửa</a>
                        <a href="/KT/KT_Php/delete/<?= $nv['Ma_NV'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>?page=<?= $i ?>">Trang <?= $i ?></a>
        <?php endfor; ?>
    </div>
</body>

</html>