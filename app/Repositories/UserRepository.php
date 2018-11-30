<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UserRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\User';
    }

    public function validateCreate() {
        return $rules = [
            'username' => 'required|unique:user',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'role_id' => 'required',
            'name' => 'required'
        ];
    }
      public function validateAdminCreate() {
        return $rules = [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'name' => 'required|unique:user',
        ];
    }
      public function validateAdminUpdate($id) {
        return $rules = [
            'name' => 'required',
        ];
    }

    public function validateCustomer() {
        return $rules = [
            'name' => 'required',
            'username' => 'required|min:6|unique:user',
            'email'=>'required|unique:user',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'id_county' => 'required',
            'id_ward' => 'required'
        ];
    }
    
    public function validateUpdate($id) {
        return $rules = [
            'username' => 'required|unique:user,username,' . $id . ',id',
            'role_id' => 'required',
            'name' => 'required'
        ];
    }

    
    function getAllCustomer($request) {
        return $this->model->where('role_id', '=', \App\User::ROLE_CUSTOMER)->get();
    }

    public function exportUser($group) {
        if (in_array(0, $group)) {
            $users = $this->model->where('role_id', '=', \App\User::ROLE_CUSTOMER)->get();
        } else {
            $check = true;
            if ($group[0] < 0) {
                $check = false;
                foreach ($group as $key => $value) {
                    $group[$key] = abs($value);
                }
            }
            if ($check == false) {
                $users = $this->model->where('role_id', '=', \App\User::ROLE_CUSTOMER)->whereNotIn('id', $group)->get();
            } else {
                $users = $this->model->where('role_id', '=', \App\User::ROLE_CUSTOMER)->whereIn('id', $group)->get();
            }
        }
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', trans('base.id'))
                ->setCellValue('B1', trans('base.fullname'))
                ->setCellValue('C1', trans('base.tel'))
                ->setCellValue('D1', trans('base.email'))
                ->setCellValue('E1', trans('base.school'))
                ->setCellValue('F1', trans('base.created_at'))
                ->setCellValue('G1', trans('base.basis_code'))
                ->setCellValue('H1', trans('base.schedule'))
                ->setCellValue('I1', trans('base.link'));

        foreach ($users as $key => $user) {
            $row = $key + 2;
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $row, $user->id)
                    ->setCellValue('B' . $row, $user->fullname)
                    ->setCellValue('C' . $row, $user->tel())
                    ->setCellValue('D' . $row, $user->email)
                    ->setCellValue('E' . $row, $user->school)
                    ->setCellValue('F' . $row, $user->created_at)
                    ->setCellValue('G' . $row, $user->basis->name)
                    ->setCellValue('H' . $row, $user->schedule->name)
                    ->setCellValue('I' . $row, $user->affiliate->name);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="danh-sach-thanh-vien.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

     public function exportCustomer($group) {
        if (in_array(0, $group)) {
            $members = $this->model->where('role_id', '=', \App\User::ROLE_CUSTOMER)->get();
        } else {
            $check = true;
            if ($group[0] < 0) {
                $check = false;
                foreach ($group as $key => $value) {
                    $group[$key] = abs($value);
                }
            }
            if ($check == false) {
                $members = $this->model->where('role_id', '=', \App\User::ROLE_CUSTOMER)->whereNotIn('id', $group)->get();
            } else {
                $members = $this->model->where('role_id', '=', \App\User::ROLE_CUSTOMER)->whereIn('id', $group)->get();
            }
        }
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Mã khách hàng')
                ->setCellValue('B1','Tên khách hàng')
                ->setCellValue('C1', 'Địa chỉ')
                
                ->setCellValue('D1', 'Ngày đăng ký')
                ->setCellValue('E1', 'SĐT')
                ->setCellValue('F1', 'Email');
                

        foreach ($members as $key => $member) {
            $row = $key + 2;
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $row, $member->id)
                    ->setCellValue('B' . $row, $member->name)
                    ->setCellValue('C' . $row, $member->address)
                   
                    ->setCellValue('D' . $row, $member->created_at)
                    ->setCellValue('E' . $row, $member->phone())
                    ->setCellValue('F' . $row, $member->email);
                    
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="danh-sach-thanh-vien.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }






         public function getAdmin() {
        $query = $this->model->whereIn('role_id', \App\Role::ROLE_QTV)->get();
        return $query;
    }
}
