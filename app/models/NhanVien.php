<?php


class NhanVien
{
    private $conn;
    private $table_name = "nhanvien";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll($limit, $offset)
    {
        $query = "SELECT p.*, c.Ten_Phong as Ten_Phong 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN phongban c ON p.Ma_Phong = c.Ma_Phong
                                    LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTotalNhanViens()
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    public function getById($id)
    {
        $query = "SELECT Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong FROM nhanvien WHERE Ma_NV = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ?: null;
    }

    public function addNhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong)
    {
        $errors = [];

        if (empty($ma_nv)) {
            $errors['ma_nv'] = 'Mã nhân viên không được để trống';
        }
        if (empty($ten_nv)) {
            $errors['ten_nv'] = 'Tên nhân viên không được để trống';
        }
        if (!is_numeric($luong) || $luong < 0) {
            $errors['luong'] = 'Lương không hợp lệ';
        }
        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO " . $this->table_name . " (ma_nv, ten_nv, phai, noi_sinh, ma_phong, luong) 
                  VALUES (:ma_nv, :ten_nv, :phai, :noi_sinh, :ma_phong, :luong)";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $ma_nv = htmlspecialchars(strip_tags($ma_nv));
        $ten_nv = htmlspecialchars(strip_tags($ten_nv));
        $phai = htmlspecialchars(strip_tags($phai));
        $noi_sinh = htmlspecialchars(strip_tags($noi_sinh));
        $ma_phong = htmlspecialchars(strip_tags($ma_phong));
        $luong = htmlspecialchars(strip_tags($luong));

        // Bind parameters
        $stmt->bindParam(':ma_nv', $ma_nv);
        $stmt->bindParam(':ten_nv', $ten_nv);
        $stmt->bindParam(':phai', $phai);
        $stmt->bindParam(':noi_sinh', $noi_sinh);
        $stmt->bindParam(':ma_phong', $ma_phong);
        $stmt->bindParam(':luong', $luong);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 🔹 Update employee
    public function updateNhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET ten_nv = :ten_nv, phai = :phai, noi_sinh = :noi_sinh, 
                      ma_phong = :ma_phong, luong = :luong 
                  WHERE ma_nv = :ma_nv";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $ma_nv = htmlspecialchars(strip_tags($ma_nv));
        $ten_nv = htmlspecialchars(strip_tags($ten_nv));
        $phai = htmlspecialchars(strip_tags($phai));
        $noi_sinh = htmlspecialchars(strip_tags($noi_sinh));
        $ma_phong = htmlspecialchars(strip_tags($ma_phong));
        $luong = htmlspecialchars(strip_tags($luong));

        // Bind parameters
        $stmt->bindParam(':ma_nv', $ma_nv);
        $stmt->bindParam(':ten_nv', $ten_nv);
        $stmt->bindParam(':phai', $phai);
        $stmt->bindParam(':noi_sinh', $noi_sinh);
        $stmt->bindParam(':ma_phong', $ma_phong);
        $stmt->bindParam(':luong', $luong);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 🔹 Delete employee
    public function deleteNhanVien($ma_nv)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE ma_nv = :ma_nv";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ma_nv', $ma_nv);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
