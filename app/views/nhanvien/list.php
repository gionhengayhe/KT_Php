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
    </style>
</head>

<body>
    <h2>Thông Tin Nhân Viên</h2>
    <table>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới Tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
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