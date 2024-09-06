<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontendcontroller extends Controller
{
    public function index(Request $request)
    {


        return view("welcome");

    }

    public function contact(Request $request)
    {

        $name = $request->post('name') ;
        $email = $request->post('email')  ;
        $tel = $request->post('tel');
        $requirement =  $request->post('requirement');
        $package =  $request->post('package');
        $topic =  $request->post('topic');
        $datetime = date('Y-m-d H:i:s');
        if (!empty($name) && !empty($email) && !empty($tel) && !empty($requirement)) {

            // ส่งการแจ้งเตือนผ่าน LINE Notify
            $lineToken = 'AyobZcOnf5g1ulGf5TGdPcXe1NtfbW8spxCYvqZL2HU';
            $message = "มีการแจ้งเตือนจากลูกค้า\n" .
                "ชื่อ: $name\n" .
                "อีเมล: $email\n" .
                "โทรศัพท์: $tel\n" .
                "หัวข้อ: $topic\n" .
                "แพ็กเกจ: $package\n" .
                "รายละเอียด: $requirement\n";
            "วันที่เวลา: $datetime";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['message' => $message]));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $lineToken",
                "Content-Type: application/x-www-form-urlencoded"
            ]);

            $result = curl_exec($ch);
            curl_close($ch);


            return redirect('/')->with('success', 'ข้อมูลถูกส่งและมีการแจ้งเตือนทาง LINE Notify เรียบร้อย ขอบคุณที่ติดต่อเรา');

        } else {
            return redirect('/')->with('error', 'กรุณากรอกข้อมูลให้ครบถ้วน');

        }
    }
}
