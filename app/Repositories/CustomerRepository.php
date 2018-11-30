<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class CustomerRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Customer';
    }

    function getAllCustomer($request) {
        $query = $this->model;
        if ($request !== NULL) {
           
             $start_date = $request->get('start_date');
            if (!empty($start_date)) {
                $query = $query
                        ->whereDate('created_at', '>=', date('Y-m-d',strtotime($start_date)));
            }
            //             Search theo end_date
            $end_date = $request->get('end_date');
            if (!empty($end_date)) {
                $query = $query
                        ->whereDate('created_at', '<=', date('Y-m-d',strtotime($end_date)));
            }


            $searchText = $request->get('keyword');
            if (!empty($searchText)) {
                $query = $query
                        ->where('id', 'LIKE', "%" . $searchText . "%")
                        ->orWhere('name', 'LIKE', "%" . $searchText . "%")
                        ->orWhere('phone', 'LIKE', "%" . $searchText . "%");
            }
        }

        $members = $query->orderBy('created_at', 'DESC')->get();
        return $members;
    }
      public function validateCreate() {
        return $rules = [
            'name' => 'required'            

        ];
    }
     public function validateUpdate($id) {
        return $rules = [
            'name' => 'required:english,name,' . $id . ',id'
           
        ];
    }
     function deleteGroup($group) {
        if (in_array(0, $group)) {

            $eng = $this->model->whereNotIn('id', $group);
            $english_detail = $this->model->all();
            $eng->delete();
        } else {
            $check = true;

            if ($group[0] < 0) {
                $check = false;
                foreach ($group as $key => $value) {
                    $group[$key] = abs($value);
                }
            }

            if ($check == false) {
                $eng = $this->model->whereNotIn('id', $group);
            } else {
                $eng = $this->model->whereIn('id', $group);
                foreach ($group as $key => $value) {
                    $eng = $this->model->find($value);
                    $eng->delete();
                }
            }
        }
    }


    public function exportCustomer($group) {
        if (in_array(0, $group)) {
            $members = $this->model->get();
        } else {
            $check = true;
            if ($group[0] < 0) {
                $check = false;
                foreach ($group as $key => $value) {
                    $group[$key] = abs($value);
                }
            }
            if ($check == false) {
                $members = $this->model->whereNotIn('id', $group)->get();
            } else {
                $members = $this->model->whereIn('id', $group)->get();
            }
        }
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Mã khách hàng')
                ->setCellValue('B1','Tên khách hàng')
                ->setCellValue('C1', 'Thành phố')
                ->setCellValue('D1','Quận huyện')
                ->setCellValue('E1', 'Xã phường')
                ->setCellValue('F1', 'Ngày đăng ký')
                ->setCellValue('G1', 'SĐT')
                ->setCellValue('H1', 'Email');
                

        foreach ($members as $key => $member) {
            $row = $key + 2;
            $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $row, $member->id)
                    ->setCellValue('B' . $row, $member->name)
                    ->setCellValue('C' . $row, $member->city->name)
                    ->setCellValue('D' . $row, $member->id_county)
                    ->setCellValue('E' . $row, $member->id_ward)
                    ->setCellValue('F' . $row, $member->created_at)
                    ->setCellValue('G' . $row, $member->phone())
                    ->setCellValue('H' . $row, $member->email);
                    
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="danh-sach-thanh-vien.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

}