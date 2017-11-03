<?php

namespace Kata\MagicThree;

/**
 * @package Kata\MagicThree
 */
class MagicThree
{
	/**
	 * @param array $numbers
	 *
	 * @return bool
	 */
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

		$twoLengthSubset = $this->getAllFixedLengthSubset($numbers, 2);

		foreach ($twoLengthSubset as $subset)
		{
			if (
				(array_sum($subset) + $subset[0]) == 0
				|| (array_sum($subset) + $subset[1]) == 0
			) {
				return true;
			}
		}

		$threeLengthSubset = $this->getAllFixedLengthSubset($numbers, 3);

		foreach ($threeLengthSubset as $subset)
		{
			if (array_sum($subset) == 0)
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * @param array $numbers
	 * @param int   $length
	 *
	 * @return array
	 */
	private function getAllFixedLengthSubset(array $numbers, $length)
	{
		if (count($numbers) < $length)
		{
			return [];
		}

		if (count($numbers) == $length)
		{
			return [0 => $numbers];
		}

		$number = array_pop($numbers);

		if (is_null($number))
		{
			return [];
		}

		return array_merge(
			$this->getAllFixedLengthSubset($numbers, $length),
			$this->mergeIntoEachSubset($number, $this->getAllFixedLengthSubset($numbers, $length - 1))
		);
	}

	/**
	 * @param int   $number
	 * @param array $numbers
	 *
	 * @return array
	 */
	private function mergeIntoEachSubset($number, array $numbers)
	{
		foreach ($numbers as &$n)
		{
			array_push($n, $number);
		}

		return $numbers;
	}
}