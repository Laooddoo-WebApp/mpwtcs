<?php
$url = $_SERVER['REQUEST_URI'];

date_default_timezone_set('Asia/Vientiane');
if (strstr($url, '/en')) {
    echo date('l,F d,Y');
} else {
    $laoDaysArray = [
        'Monday' => 'ວັນຈັນ',
        'Tuesday' => 'ວັນອັງຄານ',
        'Wednesday' => 'ວັນພຸດ',
        'Thursday' => 'ວັນພະຫັດ',
        'Friday' => 'ວັນ​ສຸກ',
        'Saturday' => 'ວັນເສົາ',
        'Sunday' => 'ວັນອາທິດ',
    ];

    $laoMonthsArray = [
        'January' => 'ມັງກອນ',
        'February' => 'ກຸມພາ',
        'March' => 'ມີນາ',
        'April' => 'ເດືອນເມສາ',
        'May' => 'ພຶດສະພາ',
        'June' => 'ມິຖຸນາ',
        'July' => 'ເດືອນກໍລະກົດ',
        'August' => 'ສິງຫາ',
        'September' => 'ກັນຍາ',
        'October' => 'ເດືອນຕຸລາ',
        'November' => 'ພະຈິກ',
        'December' => 'ທັນວາ',
    ];

    $datetime = date('l,F d,Y');
    foreach ($laoDaysArray as $key => $value) {
        $datetime = str_replace($key, $value, $datetime);
    }

    foreach ($laoMonthsArray as $key => $value) {
        $datetime = str_replace($key, $value, $datetime);
    }

    echo $datetime;
}
