<?php
// Require necessary files
require_once('app/config/database.php');
require_once('app/models/NhanVien.php');

class NhanVienController
{
    private $nhanVienModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->nhanVienModel = new NhanVien($this->db);
    }

    public function index()
    {
        $limit = 5; // Số nhân viên mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $nhanviens = $this->nhanVienModel->getAll($limit, $offset);
        $totalNhanViens = $this->nhanVienModel->getTotalNhanViens();
        $totalPages = ceil($totalNhanViens / $limit);

        include 'app/views/nhanvien/list.php';
    }

    public function show($id)
    {
        $employee = $this->nhanVienModel->getById($id);

        if ($employee) {
            include 'app/views/nhanvien/show.php';
        } else {
            echo "Không tìm thấy nhân viên.";
        }
    }

    public function add()
    {
        $phongban = (new PhongBan($this->db))->getAll();
        include_once 'app/views/nhanvien/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_nv = $_POST['ma_nv'] ?? '';
            $ten_nv = $_POST['ten_nv'] ?? '';
            $phai = $_POST['phai'] ?? '';
            $noi_sinh = $_POST['noi_sinh'] ?? '';
            $ma_phong = $_POST['ma_phong'] ?? '';
            $luong = $_POST['luong'] ?? '';

            $result = $this->nhanVienModel->addNhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong);

            if (is_array($result)) {
                $errors = $result;
                include 'app/views/nhanvien/add.php';
            } else {
                header('Location: /KT/KT_Php');
            }
        }
    }

    public function edit($id)
    {
        $employee = $this->nhanVienModel->getById($id);

        if ($employee) {
            include 'app/views/nhanvien/edit.php';
        } else {
            echo "Không tìm thấy nhân viên.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ma_nv = $_POST['ma_nv'];
            $ten_nv = $_POST['ten_nv'];
            $phai = $_POST['phai'];
            $noi_sinh = $_POST['noi_sinh'];
            $ma_phong = $_POST['ma_phong'];
            $luong = $_POST['luong'];

            $edit = $this->nhanVienModel->updateNhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong);

            if ($edit) {
                header('Location: /KT/KT_Php');
            } else {
                echo "Đã xảy ra lỗi khi cập nhật nhân viên.";
            }
        }
    }

    public function delete($id)
    {
        if ($this->nhanVienModel->deleteNhanVien($id)) {
            header('Location: /KT/KT_Php');
        } else {
            echo "Đã xảy ra lỗi khi xóa nhân viên.";
        }
    }
}
