<?php
namespace App\Controller;

use App\Models\Staff;
use Controller;
use Exception;
use Response;
use Session;

class StaffController extends Controller
{
    protected $table = 'staff_info';
    public $response;
    public $staffs;
    public $data = [];

    public function __construct() {
         $this->staffs = new Staff();
         $this->response = new Response();
    }

    public function index() {
        $staffs = $this->db->table($this->table)->get();

        // return $this->response->json($staffs);
        $this->data['sub_content']['new_title'] = $staffs;
        $this->data['content'] = 'staffs/fulltime';

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
        $staff = $this->db->table($this->table)->where('id','=', $id)->get();

        return $this->response->json($staff);
    }

    public function update($data, $id) {
        //update
        try {
            $this->db->table($this->table)->where('id','=', $id)->update($data);
            $this->response->redirect('staff/getStaffFulltime');
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
            $this->response->redirect('staff/getStaffFulltime');
        } catch (Exception $exception) {
            echo "Đã xảy ra lỗi khi xóa bản ghi";
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function getUserInfo($id) {
        $user = $this->db->table($this->table)
        ->leftJoin('department_info', 'staff_info.department_id = department_info.id')
        ->leftJoin('diploma', 'staff_info.diploma_id = diploma.id')
        ->leftJoin('position', 'staff_info.position_id = position.id')
        ->leftJoin('marriage_status', 'staff_info.marriage_code = marriage_status.id')
        ->leftJoin('staff_type', 'staff_info.staff_type_id = staff_type.id')
        ->leftJoin('reward_discipline', 'staff_info.id = reward_discipline.staff_id')
        ->where('staff_info.id','=', $id)->get();

        $this->data['sub_content']['user_info'] = $user;
        $this->data['content'] = 'profile/show';

        $this->render('layouts\client_layout', $this->data);
    }

    public function getStaffFulltime() {
        $fulltime = $this->db->table($this->table)
        ->select('staff_info.id, staff_info.staff_code, staff_info.staff_fullname, staff_info.date_of_birth, staff_info.id_number, staff_info.domicile, staff_info.date_start_work, staff_info.status, department_info.department_name, diploma.diploma_name, position.position_name, marriage_status.marriage_status_name, staff_type.staff_name')
        ->leftJoin('department_info', 'staff_info.department_id = department_info.id')
        ->leftJoin('diploma', 'staff_info.diploma_id = diploma.id')
        ->leftJoin('position', 'staff_info.position_id = position.id')
        ->leftJoin('marriage_status', 'staff_info.marriage_code = marriage_status.id')
        ->leftJoin('staff_type', 'staff_info.staff_type_id = staff_type.id')
        ->where('staff_type.note', '=', 'fulltime')
        ->orderBy('staff_info.status', 'DESC')
        ->get();

        $this->data['sub_content']['staffs'] = $fulltime;
        $this->data['content'] = 'staffs/fulltime';

        $this->render('layouts\client_layout', $this->data);
    }

    public function getStaffParttime() {
        $parttime = $this->db->table($this->table)
        ->select('staff_info.id, staff_info.staff_code, staff_info.staff_fullname, staff_info.date_of_birth, staff_info.id_number, staff_info.domicile, staff_info.date_start_work, staff_info.status, department_info.department_name, diploma.diploma_name, position.position_name, marriage_status.marriage_status_name, staff_type.staff_name')
        ->leftJoin('department_info', 'staff_info.department_id = department_info.id')
        ->leftJoin('diploma', 'staff_info.diploma_id = diploma.id')
        ->leftJoin('position', 'staff_info.position_id = position.id')
        ->leftJoin('marriage_status', 'staff_info.marriage_code = marriage_status.id')
        ->leftJoin('staff_type', 'staff_info.staff_type_id = staff_type.id')
        ->where('staff_type.note', '=', 'parttime')
        ->orderBy('staff_info.status', 'DESC')
        ->get();

        $this->data['sub_content']['staffs'] = $parttime;
        $this->data['content'] = 'staffs/parttime';

        $this->render('layouts\client_layout', $this->data);
    }

    public function getInternship() {
        $parttime = $this->db->table($this->table)
        ->select('staff_info.id, staff_info.staff_code, staff_info.staff_fullname, staff_info.date_of_birth, staff_info.id_number, staff_info.domicile, staff_info.date_start_work, staff_info.status, department_info.department_name, diploma.diploma_name, position.position_name, marriage_status.marriage_status_name, staff_type.staff_name')
        ->leftJoin('department_info', 'staff_info.department_id = department_info.id')
        ->leftJoin('diploma', 'staff_info.diploma_id = diploma.id')
        ->leftJoin('position', 'staff_info.position_id = position.id')
        ->leftJoin('marriage_status', 'staff_info.marriage_code = marriage_status.id')
        ->leftJoin('staff_type', 'staff_info.staff_type_id = staff_type.id')
        ->where('staff_type.note', '=', 'internship')
        ->orderBy('department_info.department_name')
        ->orderBy('staff_info.status', 'DESC')
        ->get();

        $this->data['sub_content']['staffs'] = $parttime;
        $this->data['content'] = 'staffs/intern';

        $this->render('layouts\client_layout', $this->data);
    }

    public function check($id='') {
        Session::flash('inputImage', $_FILES['avatar']);
        $this->staffs->validateData();

        $check = getUrlAction();
        if (!empty($check) ) {
            switch ($check) {
                case 'edit':
                    $this->response->redirect('staff/edit/' . $id);
                    break;

                case 'create':
                    $this->response->redirect('staff/create');
                    break;

                default:
                    $this->response->redirect('staff/index');
                    break;
            }
        }
    }

    public function create() {
        global $config;
        $sessionData = isset($_SESSION[$config['session']['session_key']]) ? $_SESSION[$config['session']['session_key']] : [];

        if (isset($sessionData['errors_staff']) && isset($sessionData['old_data_staff']['submit'])) {
            if (!isset($sessionData['errors_staff']['staff_fullname']) && !isset($sessionData['errors_staff']['avatar']) && !isset($sessionData['errors_staff']['gender']) && !isset($sessionData['errors_staff']['date_of_birth']) && !isset($sessionData['errors_staff']['date_start_work']) && !isset($sessionData['errors_staff']['marriage_code']) && !isset($sessionData['errors_staff']['id_number']) && !isset($sessionData['errors_staff']['staff_type_id']) && !isset($sessionData['errors_staff']['diploma_id']) && !isset($sessionData['errors_staff']['department_id']) && !isset($sessionData['errors_staff']['position_id'])) {
                unset($sessionData['old_data_staff']['submit']);
                mt_srand(10);
                $staffCode = 'MNV' . mt_rand();
                $diploma = $this->db->table('diploma')->select('id')->where('diploma_name','=', $sessionData['old_data_staff']['diploma_id'])->first();
                $department = $this->db->table('department_info')->select('id')->where('department_name','=', $sessionData['old_data_staff']['department_id'])->first();
                $position = $this->db->table('position')->select('id')->where('position_name','=', $sessionData['old_data_staff']['position_id'])->first();
                $staffType = $this->db->table('staff_type')->select('id')->where('staff_name','=', $sessionData['old_data_staff']['staff_type_id'])->first();
                $marriage = $this->db->table('marriage_status')->select('id')->where('marriage_status_name','=', $sessionData['old_data_staff']['marriage_code'])->first();
                $sessionData['old_data_staff']['staff_code'] = $staffCode;
                var_dump('111');
                if (!isset($sessionData['old_data_staff']['submit'])) {
                    Session::flash('status', 'add');

                    uploadFileImage($sessionData['inputImage']);

                    $data = [
                        'staff_code' => $staffCode,
                        'avatar' => isset($sessionData['old_data_staff']['avatar']) ? strval($sessionData['old_data_staff']['avatar']) : '',
                        'staff_fullname' => isset($sessionData['old_data_staff']['staff_fullname']) ? strval($sessionData['old_data_staff']['staff_fullname']) : '',
                        'nickname' => isset($sessionData['old_data_staff']['nickname']) ? strval($sessionData['old_data_staff']['nickname']) : '',
                        'gender' => isset($sessionData['old_data_staff']['gender']) ? strval($sessionData['old_data_staff']['gender']) : '',
                        'date_of_birth' => isset($sessionData['old_data_staff']['date_of_birth']) ? date('Y-m-d',strtotime(str_replace('/', '-', $sessionData['old_data_staff']['date_of_birth']))) : '',
                        'date_start_work' => isset($sessionData['old_data_staff']['date_start_work']) ? date('Y-m-d',strtotime(str_replace('/', '-', $sessionData['old_data_staff']['date_start_work']))) : '',
                        'marriage_code' => isset($marriage['id']) ? intval($marriage['id']) : 1,
                        'id_number' => isset($sessionData['old_data_staff']['id_number']) ? intval($sessionData['old_data_staff']['id_number']) : 000000000,
                        'diploma_id' => isset($diploma['id']) ? intval($diploma['id']) : 0,
                        'staff_type_id' => isset($staffType['id']) ? intval($staffType['id']) : 2,
                        'department_id' => isset($department['id']) ? intval($department['id']) : 25,
                        'position_id' => isset($position['id']) ? intval($position['id']) : 33,
                        'date_issue_id' => isset($sessionData['old_data_staff']['date_issue_id']) ? date('Y-m-d',strtotime(str_replace('/', '-', $sessionData['old_data_staff']['date_issue_id']))) : '',
                        'place_issue_id' => isset($sessionData['old_data_staff']['place_issue_id']) ? strval($sessionData['old_data_staff']['place_issue_id']) : '',
                        'domicile' => isset($sessionData['old_data_staff']['domicile']) ? strval($sessionData['old_data_staff']['domicile']) : '',
                        'hobby' => isset($sessionData['old_data_staff']['hobby']) ? strval($sessionData['old_data_staff']['hobby']) : '',
                        'status' => 'Active'
                    ];

                    $this->store($data);
                    $this->response->redirect('nhan-vien/full-time');
                    exit;
                }
            }
        }

        $this->data['sub_content']['staffs'] = '';
        $this->data['content'] = 'staffs/add';

        $this->render('layouts\client_layout', $this->data);
    }
}
        