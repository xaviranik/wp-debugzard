<?php


use PhpKnight\WpDd\Dumper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;

class DumperTest extends TestCase {

	use VarDumperTestTrait;

	/**
	 * Provides data for test_it_can_dump_a_string.
	 *
	 * @return array[]
	 */
	public function provide_string_data(): array {
		return [
			[
				'"Hello World"',
				'Hello World'
			],
			[
				'"123"',
				'123'
			],
		];
	}

	/**
	 * Provides data for test_it_can_dump_a_number.
	 *
	 * @return array[]
	 */
	public function provide_number_data(): array {
		return [
			[
				'123',
				123
			],
			[
				'123.0',
				123.0
			]
		];
	}

	/**
	 * Provides data for test_it_can_dump_a_boolean.
	 *
	 * @return array[]
	 */
	public function provide_boolean_data(): array {
		return [
			[
				'true',
				true
			],
			[
				'false',
				false
			]
		];
	}

	/**
	 * @dataProvider provide_string_data
	 *
	 * @throws ErrorException
	 */
	public function test_it_can_dump_a_string( $expected, $input ): void {
		$dump = Dumper::debug_dump( $input );
		$this->assertSame( $this->prepareExpectation( $expected , 0 ), $dump );
	}

	/**
	 * @dataProvider provide_number_data
	 *
	 * @throws ErrorException
	 */
	public function test_it_can_dump_a_number( $expected, $input ): void {
		$dump = Dumper::debug_dump( $input );
		$this->assertSame( $this->prepareExpectation( $expected , 0 ), $dump );
	}

	/**
	 * @dataProvider provide_boolean_data
	 *
	 * @throws ErrorException
	 */
	public function test_it_can_dump_a_boolean( $expected, $input ): void {
		$dump = Dumper::debug_dump( $input );
		$this->assertSame( $this->prepareExpectation( $expected , 0 ), $dump );
	}


	/**
	 * @throws ErrorException
	 */
	public function test_it_can_dump_a_object() {
		$class = new stdClass();
		$class->foo = 'bar';
		$class->fizz = 'buzz';

		$dump = Dumper::debug_dump( $class );
		$expected = <<<'EOD'
{#427
  +"foo": "bar"
  +"fizz": "buzz"
}
EOD;

		$this->assertSame( $this->prepareExpectation( $expected , 0 ), $dump );
	}
}
