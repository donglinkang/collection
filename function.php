<?php

/**
 * 计算两个时间的间隔时间
 * @param $time
 * @param null $other
 * @return string
 */
function diffTimeHumans($time, $other=null) {
    empty($other) && $other = time();

    $diff = $other - $time;

    // 判断要计算的时间是否大于当前时间
    $isFuture = true;
    if ($diff > 0) {
        $isFuture = false;
    }

    // 取绝对值
    $diff = abs($diff);

    $map = [
        0 => ['title' => '秒', 'denominator' => 60],
        1 => ['title' => '分', 'denominator' => 60],
        2 => ['title' => '时', 'denominator' => 24],
        3 => ['title' => '天', 'denominator' => 30],
        4 => ['title' => '月', 'denominator' => 12],
        5 => ['title' => '年', 'denominator' => 100]
    ];
    $index = -1;

    $result = [];
    while ($diff > 0) {
        $index++;
        $result[$index] = $diff % $map[$index]['denominator'];
        $diff = ($diff - $result[$index]) / $map[$index]['denominator'];
    }

    $str = '';
    foreach ($result as $k=>$v) {
        $str = $v.$map[$k]['title'].$str;
    }
    return $isFuture ? '剩余'.$str : '超过'.$str;
}


/**
 * 根据经纬度计算两个地址的球面距离
 * @param $lat1 纬度1
 * @param $lng1 经度1
 * @param $lat2 纬度2
 * @param $lng2 经度2
 * @return float 距离(米)
 */
function getDistance($lat1,$lng1,$lat2,$lng2)
{
    //地球半径
    $R = 6372797;

    //将角度转为狐度
    $radLat1 = deg2rad($lat1);
    $radLat2 = deg2rad($lat2);
    $radLng1 = deg2rad($lng1);
    $radLng2 = deg2rad($lng2);

    //结果
    return round(acos(cos($radLat1)*cos($radLat2)*cos($radLng1-$radLng2)+sin($radLat1)*sin($radLat2))*$R, 2);
}