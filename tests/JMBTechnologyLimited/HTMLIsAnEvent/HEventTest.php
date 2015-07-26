<?php


namespace JMBTechnologyLimited\HTMLIsAnEvent;


/**
 *
 * @link https://github.com/JMB-Technology-Limited/HTMLIsAnEvent
 * @license https://raw.github.com/JMB-Technology-Limited/HTMLIsAnEvent/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2015, JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class HEventTest  extends \PHPUnit_Framework_TestCase {



	function testFile1() {

		$parser = new Parser(file_get_contents(__DIR__.DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."hevent1.html"), "http://example.com");

		$events = $parser->getEvents();

		$this->assertEquals(3, count($events));

		$event1 = $events[0];


		$this->assertEquals("IndieWebCamp 2014",$event1->getTitle());
		$this->assertEquals("http://indiwebcamp.com/2014",$event1->getUrl());


		$event2 = $events[1];


		$this->assertEquals("IndieWebCampSF",$event2->getTitle());
		$this->assertEquals("http://indiewebcamp.com/2014/SF",$event2->getUrl());

		$event3 = $events[2];


		$this->assertEquals("Homebrew Website Club",$event3->getTitle());
		$this->assertEquals("http://indiewebcamp.com/events/2014-01-15-homebrew-website-club",$event3->getUrl());






	}






}

