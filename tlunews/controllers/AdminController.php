<?php
require_once APP_ROOT . '/tlunews/service/UserSevice.php';

class AdminController {
    public function index() {
        //goi du lieu tu service
        $userService = new UserService();
        $admins = $userService->getAllUsers();
        
        //render dulieu ra 
        include APP_ROOT . '/tlunews/views/admin/dashboard.php';
    }
}