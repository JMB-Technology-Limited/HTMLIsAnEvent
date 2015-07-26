<?php


namespace JMBTechnologyLimited\HTMLIsAnEvent;


/**
 *
 * @link https://github.com/JMB-Technology-Limited/HTMLIsAnEvent
 * @license https://raw.github.com/JMB-Technology-Limited/HTMLIsAnEvent/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2015, JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class AbsoluteURLTest  extends \PHPUnit_Framework_TestCase {

	function dataForTestAbsoluteURL() {
		return array(
			array('http://www.example.com','/cat','http://www.example.com/cat'),
			array('http://www.example.com/dog','/cat','http://www.example.com/cat'),
			array('http://www.example.com/dog','http://www.google.com/cat','http://www.google.com/cat'),
		);
	}

	/**
	 * @dataProvider dataForTestAbsoluteURL
	 */

	function testAbsoluteURL($url, $in, $out) {
		$parser = new ParserAbsoluteURLTester();
		$this->assertEquals($out, $parser->getAbsoluteURLTester($url, $in));
	}

}


class ParserAbsoluteURLTester extends Parser {


	function __construct()
	{

	}

	public function getAbsoluteURLTester($url, $in) {

		$this->url = $url;
		return $this->getAbsoluteURL($in);
	}

}
