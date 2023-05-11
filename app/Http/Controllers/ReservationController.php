<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation as ReservModel;

use function GuzzleHttp\Promise\all;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservation');
    }
    public function show(Request $request)
    {

        header("Content-type: application/json");
        $output = [];
        $output['reservation'] = ReservModel::get();
        $output['serverDate'] = date("Y-m-d", time());
        echo json_encode($output);
    }
    public function store()
    {

        $json_data = json_decode(file_get_contents("php://input"), true, 512, JSON_THROW_ON_ERROR);

        if (
            !isset($json_data['phone']) ||
            !isset($json_data['name']) ||
            !isset($json_data['date']) ||
            !isset($json_data['place'])
        ) {
            echo "잘못된 접근입니다.";
            exit;
        }

        $phone = $json_data['phone'];
        $name = $json_data['name'];
        $date = $json_data['date'];
        $place = $json_data['place'];
        dd($phone);

        $complList = ReservModel::select("*")->where('date', '=', '$date')->where('place', '=', '$place')->first();

        if ($complList) {
            echo "이미 예약이 완료된 자리입니다.";
            exit;
        }

        $rs = ReservModel::create([$name, $phone, $place, $date]);
        // DB::execute("INSERT INTO reservation (name, phone, date, place, type, create_date) VALUES (?,?,?,?,'ongoing', now())", [$name, $phone, $date, $place]);

        $_SESSION['user'] = [
            'phone' => $phone,
            'name' => $name
        ];
    }
}
