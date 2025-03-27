<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/PhongBan.php');

class PhongBanController
{
    private $phongban;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->phongban = new PhongBan($this->db);
    }

    public function list()
    {
        $phongbans = $this->phongban->getAll();
        include 'app/views/phongban/list.php';
    }
}
