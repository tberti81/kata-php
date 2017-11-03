<?php

namespace Kata\Test\MagicThree;

use Kata\MagicThree\MagicThree;
use PHPUnit_Framework_TestCase;

/**
 * @package Kata\Test\MagicThree
 */
class MagicThreeTest extends PHPUnit_Framework_TestCase
{
	/** @var MagicThree */
	private $subject;

	/**
	 * @inheritdoc
	 */
	public function setUp()
	{
		$this->subject = new MagicThree();
	}

	/**
	 * @covers Kata\MagicThree\MagicThree
	 */
	public function testDoMagic()
	{
		$this->assertTrue($this->subject->doMagic([0]), '0');
		$this->assertTrue($this->subject->doMagic([0, 1]), '0, 1');
		$this->assertTrue($this->subject->doMagic([1, 0]), '1, 0');
		$this->assertTrue($this->subject->doMagic([1, 2, 0]), '1, 2, 0');
		$this->assertTrue($this->subject->doMagic([1, 2, 0, 4, 5]), '1, 2, 0, 4, 5');
		$this->assertTrue($this->subject->doMagic([1, -2, 1]), '1, -2, 1');
		$this->assertTrue($this->subject->doMagic([1, -1, 2]), '1, -1, 2');
		$this->assertTrue($this->subject->doMagic([3, -10, 7]), '3, -10, 7');
		$this->assertTrue($this->subject->doMagic([3, -10, 5]), '3, -10, 5');
		$this->assertTrue($this->subject->doMagic([-10, 4, 5, 7, 3]), '-10, 4, 5, 7, 3');

		$this->assertFalse($this->subject->doMagic([1]), '1');
		$this->assertFalse($this->subject->doMagic([1, -1]), '1, -1');
		$this->assertFalse($this->subject->doMagic([1, -1, 1]), '1, -1, 1');
		$this->assertFalse($this->subject->doMagic([1, 2, 3, 4, 5]), '1, 2, 3, 4, 5');
		$this->assertFalse($this->subject->doMagic([1, 4, 2, -9]), '1, 4, 2, -9');
	}
}
 