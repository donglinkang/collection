<?php

/**
 * ��������ʱ��ļ��ʱ��
 * @param $time
 * @param null $other
 * @return string
 */
function diffTimeHumans($time, $other=null) {
	empty($other) && $other = time();

	$diff = $other - $time;

	// �ж�Ҫ�����ʱ���Ƿ���ڵ�ǰʱ��
	$isFuture = true;
	if ($diff > 0) {
		$isFuture = false;
	}

	// ȡ����ֵ
	$diff = abs($diff);

	$map = [
		0 => ['title' => '��', 'denominator' => 60],
		1 => ['title' => '��', 'denominator' => 60],
		2 => ['title' => 'ʱ', 'denominator' => 24],
		3 => ['title' => '��', 'denominator' => 30],
		4 => ['title' => '��', 'denominator' => 12],
		5 => ['title' => '��', 'denominator' => 100]
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
	return $isFuture ? 'ʣ��'.$str : '����'.$str;
}