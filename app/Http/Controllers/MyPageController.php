<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Reservation as ReservModel;
use \App\Models\Order as OrderModel;

class MyPageController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect("/user")->with('flash_message', '로그인 후 이용할 수 있습니다.');
        }
        return view('mypage');
    }
    public function show(Request $request)
    {
        header("Content-type: application/json");
        $order = OrderModel::get();
        echo json_encode($order);
    }
    public function store(Request $request)
    {
        $json_data = json_decode(file_get_contents("php://input"), true, 512, JSON_THROW_ON_ERROR);

        if (
            !isset($json_data['reservationId']) ||
            !isset($json_data['orderList']) ||
            !isset($json_data['tool'])
        ) {
            echo "잘못된 접근입니다.";
            exit;
        }

        $reservationId = $json_data['reservationId'];
        $orderList = $json_data['orderList'];
        $tool = $json_data['tool'];

        $jsonData = json_encode([
            'orderList' => $orderList,
            'tool' => $tool
        ]);

        OrderModel::create(['reservation_id' => $reservationId, 'json_data' => $jsonData, 'type' => 'accept', 'create_date' => date("Y-m-d")]);
    }
    public function delete()
    {
        if (
            !isset($_GET['id'])
        ) {
            back("잘못된 접근입니다.");
        }
        ReservModel::where('id', '=', $_GET['id'])->delete();
        return redirect('/mypage')->with('flash_message', '취소되었습니다.');
    }
    public function orderDelete()
    {
        if (
            !isset($_GET['id'])
        ) {
            back("잘못된 접근입니다.");
            exit;
        }
        OrderModel::where('id', '=', $_GET['id'])->update(['type' => 'cancel']);
        return redirect('/mypage');
    }
}
