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