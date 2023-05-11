<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Reservation as ReservModel;


class UserController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function store(Request $request)
    {

        $phone = $request->input('phone');
        $name = $request->input('name');

        if ($phone == "000-0000-0000" && $name == "관리자") {
            $_SESSION['user'] = [
                'phone' => $phone,
                'name' => $name
            ];
            msgAndGo("관리자로 로그인 되었습니다.", "./manage.php#reserv");
        }



        $complList = ReservModel::get()->where('phone', '=', $phone)->first();

        if (!$complList) {
            return back()->with('flash_message', '예약정보가 없습니다.')->withInput();
            exit;
        }

        $_SESSION['user'] = [
            'phone' => $phone,
            'name' => $name
        ];

        return redirect('/mypage')->with('flash_message', '로그인 되었습니다.');
    }
}
