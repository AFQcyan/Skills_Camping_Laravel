<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Reservation as ReservModel;

class ResvManageController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('/user')->with('flash_message', '로그인 후 이용할 수 있습니다.');
        } else if ('000-0000-0000' != session('user')['phone'] && '관리자' != session('user')['name']) {
            return redirect('/user')->with('flash_message', '관리자만 이용할 수 있습니다.');
        }
        return view('manage');
    }
    public function show(Request $request)
    {
        if (
            !isset($_GET['id']) ||
            !isset($_GET['process'])
        ) {
            back("잘못된 접근입니다.");
        }

        if ($_GET['process'] == 'reject') {
            ReservModel::where('id', '=', $_GET['id'])->delete();
            return redirect('/manage/reserv#reserv')->with('flash_message', '취소되었습니다.');
        } else {
            ReservModel::where('id', '=', $_GET['id'])->update(['type' => 'complete']);
            return redirect('/manage/reserv#reserv')->with('flash_message', '승인되었습니다.');
        }
    }
}
