<?php

namespace Kata\GreedyThief;

use InvalidArgumentException;

class GreedyThief
{
	/**
	 * @param array $items All items in the shop.
	 * @param int   $n     Maximum weight of the stolen items.
	 *
	 * @return array  Stolen items with the maximum total price.
	 */
	public function steal(array $items, $n)
	{
		if (!is_int($n) || $n < 0)
		{
			throw new InvalidArgumentException(
				sprintf('Invalid n given: "%s". Must be positive integer.', $n)
			);
		}

		foreach ($items as $key => $item)
		{
			if (!isset($item['weight'], $item['price']))
			{
				throw new InvalidArgumentException(
					'Invalid item given. Each item must have "weight" and "price".'
				);
			}
		}

 		$permutations = [];

		foreach ($this->permutations($items) as $permutation)
		{
			$permutations[] = $permutation;
		}

		$maxStolenPrice = 0;
		$permutationKey = null;
		$stolenPrice    = [];
		$stolenItems    = [];

		foreach ($permutations as $key => $permutation)
		{
			$stolenPrice[$key] = 0;
			$stolenItems[$key] = [];
			$remainingWeight   = $n;

			foreach ($permutation as $item)
			{
				if ($remainingWeight - $item['weight'] < 0)
				{
					continue;
				}

				$stolenPrice[$key]  += $item['price'];
				$stolenItems[$key][] = $item;
				$remainingWeight    -= $item['weight'];
			}

			if ($stolenPrice[$key] > $maxStolenPrice)
			{
				$maxStolenPrice = $stolenPrice[$key];
				$permutationKey = $key;
			}
		}

		return null !== $permutationKey ? $stolenItems[$permutationKey] : [];
	}

	/**
	 * @param array $items
	 */
	private function permutations(array $items)
	{
		if (count($items) <= 1)
		{
			yield $items;
		}
		else
		{
			foreach ($this->permutations(array_slice($items, 1)) as $permutation)
			{
				foreach (range(0, count($items) - 1) as $i)
				{
					yield array_merge(
						array_slice($permutation, 0, $i),
						[$items[0]],
						array_slice($permutation, $i)
					);
				}
			}
		}
	}
}

