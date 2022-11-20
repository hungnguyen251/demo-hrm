<?php
namespace App\Controller;

use App\Models\Notification;
use Controller;
use Exception;
use Response;
use Session;

class NotificationController extends Controller
{
    protected $table = 'notification';
    public $response;
    public $notifications;
    public $data = [];

    public function __construct() {
        $this->notifications = new Notification();
        $this->response = new Response();
    }

    public function index() {
        $notifications = $this->db->table($this->table)->orderBy('created_at','ASC')->get();

        $this->data['sub_content']['notifications'] = $notifications;
        $this->data['content'] = 'notifications/show';

        $this->render('layouts\client_layout', $this->data);
    }

    public function store($data) {
        //store
        try {
            $this->db->table($this->table)->insert($data);
        } catch (Exception $exception) {
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function getNotificationById($id) {
        //show
        $notifications = $this->db->table($this->table)->where('id','=', $id)->get();

        return $this->response->json($notifications);
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
            $this->response->redirect('notification/index');
        } catch (Exception $exception) {
            echo "Đã xảy ra lỗi khi xóa bản ghi";
            $mess = $exception->getMessage();
            die($mess);
        }
    }

    public function changeStatus($id) {
        $check = getUrlAction();
        if (!empty($check) ) {
            switch ($check) {
                case 'approve':
                    $data =  ['status' => 'approve'];
                    $this->update($data, $id);
                    break;

                case 'cancel':
                    $data =  ['status' => 'cancel'];
                    $this->update($data, $id);
                    break;

                default:
                    echo 'Đã có lỗi phát sinh';
                    break;
            }
        }

        $this->response->redirect('notification/index');
    }

    public function create() {
        global $config;
        $this->notifications->validateData();

        $sessionData = isset($_SESSION[$config['session']['session_key']]) ? $_SESSION[$config['session']['session_key']] : [];

        if (isset($sessionData['old_data_noti']['submit']) && isset($sessionData['login_user'])) {
            $startTime = isset($sessionData['old_data_noti']['start_time']) ? $sessionData['old_data_noti']['start_time'] : '';
            $startDate = isset($sessionData['old_data_noti']['start_date']) ? $sessionData['old_data_noti']['start_date'] : '';
            $endTime = isset($sessionData['old_data_noti']['end_time']) ? $sessionData['old_data_noti']['end_time'] : '';
            $endDate = isset($sessionData['old_data_noti']['end_date']) ? $sessionData['old_data_noti']['end_date'] : '';
            $note = isset($sessionData['old_data_noti']['note']) ? $sessionData['old_data_noti']['note'] : '';
            $numberLeave = isset($sessionData['old_data_noti']['number_leave']) ? $sessionData['old_data_noti']['number_leave'] : '';

            $content = [
                'Nghỉ từ : ' . $startTime . ' ' . $startDate,
                'Đến : ' .$endTime . ' ' . $endDate,
                'Số ngày nghỉ : ' .  $numberLeave,
                'Lý do : ' . $sessionData['old_data_noti']['reason'],
                'Bàn giao công việc : ' . $note,
            ];
            $data = [
                'title' => $sessionData['old_data_noti']['title'],
                'content' => implode(', ', $content),
                'staff_id' => $sessionData['login_user']['staff_id'],
                'author' => $sessionData['login_user']['first_name'] . ' ' . $sessionData['login_user']['last_name'] ,
                'department' => $sessionData['login_user']['department']
            ];

            $this->store($data);
            $this->response->redirect('notification/index');
            exit;
        }
        
        Session::flash('change_status', 'failed');
        $this->response->redirect('notification/index');
    }
}
        