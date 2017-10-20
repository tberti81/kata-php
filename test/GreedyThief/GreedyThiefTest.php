<?php

namespace Kata\Test\GreedyThief;

use InvalidArgumentException;
use Kata\GreedyThief\GreedyThief;
use PHPUnit_Framework_TestCase;

class GreedyThiefTest extends PHPUnit_Framework_TestCase
{
	/** @var GreedyThief */
	private $subject;

	/**
	 * @inheritdoc
	 */
	public function setUp()
	{
		$this->subject = new GreedyThief();
	}

	/**
	 * @covers Kata\GreedyThief\GreedyThief
	 *
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage Invalid n given: "-1". Must be positive integer.
	 */
	public function testStealThrowsExceptionIfNInvalid()
	{
		$this->subject->steal(['bla', 'bla'], -1);
	}

	/**
	 * @covers Kata\GreedyThief\GreedyThief
	 *
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage Invalid item given. Each item must have "weight" and "price".
	 */
	public function testStealThrowsExceptionIfItemsInvalid()
	{
		$this->subject->steal(['bla', 'bla'], 1);
	}

	/**
	 * @covers Kata\GreedyThief\GreedyThief
	 *
	 * @dataProvider dataProvider
	 *
	 * @param array $items
	 * @param int   $n
	 * @param array $expectedItems
	 */
	public function testStealWithValidInput($items, $n, $expectedItems)
	{
		$this->assertSame($expectedItems, $this->subject->steal($items, $n));
	}

	/**
	 * @return array
	 */
	public function dataProvider()
	{
		return [
			// No item in the shop
			[
				[],
				0,
				[]
			],
			// 1 item but too heavy
			[
				[
					['weight' => 2, 'price' => 10]
				],
				1,
				[]
			],
			// 1 item with good weight
			[
				[
					['weight' => 0.99, 'price' => 10]
				],
				1,
				[
					['weight' => 0.99, 'price' => 10]
				]
			],
			// Example on the page
			[
				[
					['weight' => 2, 'price' => 6],
					['weight' => 2, 'price' => 3],
					['weight' => 6, 'price' => 5],
					['weight' => 5, 'price' => 4],
					['weight' => 4, 'price' => 6],
				],
				10,
				[
					['weight' => 2, 'price' => 6],
					['weight' => 2, 'price' => 3],
					['weight' => 4, 'price' => 6],
				],
			],
			// Worthy to stole 2 easier items than 1 heavier
			[
				[
					['weight' => 2, 'price' => 6],
					['weight' => 4, 'price' => 6],
					['weight' => 6, 'price' => 5],
					['weight' => 3, 'price' => 4],
					['weight' => 1, 'price' => 3],
					['weight' => 2, 'price' => 3],
				],
				15,
				[
					['weight' => 2, 'price' => 6],
					['weight' => 4, 'price' => 6],
					['weight' => 6, 'price' => 5],
					['weight' => 1, 'price' => 3],
					['weight' => 2, 'price' => 3],
				]
			]
		];
	}
}
