<?php

namespace Kata\MagicThree;

class MagicThree
{
	public function doMagic(array $numbers)
	{
		if (array_search(0, $numbers) !== false)
		{
			return true;
		}
		elseif (count($numbers) < 2)
		{
			return false;
		}

		$numbers2 = $this->getAllSubset($numbers, 2);

		foreach ($numbers2 as $number2)
		{
			if (
				(array_sum($number2) + $number2[0]) == 0
				|| (array_sum($number2) + $number2[1]) == 0
			) {
				return true;
			}
		}

		$numbers3 = $this->getAllSubset($numbers, 3);

		foreach ($numbers3 as $number3)
		{
			if (array_sum($number3) == 0)
			{
				return true;
			}
		}

		return false;
	}

	private function getAllSubset($numbers, $length)
	{
		if (count($numbers) < $length)
		{
			return [];
		}

		if (count($numbers) == $length)
		{
			return [0 => $numbers];
		}

		$x = array_pop($numbers);

		if (is_null($x))
		{
			return [];
		}

		return array_merge(
			$this->getAllSubset($numbers, $length),
			$this->mergeIntoEach($x, $this->getAllSubset($numbers, $length - 1))
		);
	}

	private function mergeIntoEach($number, $numbers)
	{
		foreach ($numbers as &$n)
		{
			array_push($n, $number);
		}

		return $numbers;
	}
}