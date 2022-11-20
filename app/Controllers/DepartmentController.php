<?php
namespace App\Controller;

use App\Models\Department;
use Controller;
use Exception;
use Response;
use PDO;

class DepartmentController extends Controller
{
    protected $table = 'department_info';
    public $response;
    public $departments;
    public $data = [];

    public function __construct() {
         $this->departments = new Department();
         $this->response = new Response();
    }

    public function index() {
        $departments = $this->db->table($this->table)->get();
        $getCount = $this->countStaffInDepartment();
        $leader = $this->getLeaderDepartment();

        $this->data['sub_content']['leader'] = !empty($leader) ? $leader : '';
        $this->data['sub_content']['countStaff'] = !empty($getCount) ? $getCount : '';
        $this->data['sub_content']['departments'] = $departments;
        $this->data['content'] = 'departments/show';

        $this->render('layouts\client_layout', $this->data);
    }

    public function store($data) {
        //store
        try {
            $this->db->table($this->table)->insert($data);
        } catch (Exception $exception) {
            echo "Đã xảy ra lỗi thêm bản ghi";
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function show($id) {
        //show
        $department = $this->db->table($this->table)->where('id','=', $id)->get();

        return $this->response->json($department);
    }

    public function update($data, $id) {
        //update
        try {
            $this->db->table($this->table)->where('id','=', $id)->update($data);
        } catch (Exception $exception) {
            echo "Đã xảy ra lỗi khi sửa bản ghi";
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function destroy($id) {
        //destroy
        try {
            $this->db->table($this->table)->where('id','=', $id)->delete();
        } catch (Exception $exception) {
            echo "Đã xảy ra lỗi khi xóa bản ghi";
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function countStaffInDepartment() {
        $sql = "SELECT SUM(CASE When department_info.department_name ='Phòng IT' Then 1 Else 0 End ) as MBP1569204142,
                        SUM(CASE When department_info.department_name ='Phòng tổ chức - hành chính' Then 1 Else 0 End ) as MBP1569204111,
                        SUM(CASE When department_info.department_name ='Phòng kinh doanh' Then 1 Else 0 End ) as MBP1569204120,
                        SUM(CASE When department_info.department_name ='Phòng tài chính - kế toán' Then 1 Else 0 End ) as MBP1569204129,
                        SUM(CASE When department_info.department_name ='Phòng Marketing' Then 1 Else 0 End ) as MBP1569204214,
                        SUM(CASE When department_info.department_name ='Phòng kĩ thuật' Then 1 Else 0 End ) as MBP1569204303
                FROM staff_info
                JOIN department_info ON department_info.id =staff_info.department_id";
        $query = $this->db->query($sql);

        if (!empty($query)) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function getLeaderDepartment() {
        $leader = $this->db->table('staff_info')->select('staff_info.staff_fullname, staff_info.department_id')
                    ->leftJoin('position', 'staff_info.position_id = position.id')
                    ->where('position.position_name', '=', 'Trưởng phòng')
                    ->where('staff_info.status', '=', '1')
                    ->get();

        return $leader;
    }
}
        