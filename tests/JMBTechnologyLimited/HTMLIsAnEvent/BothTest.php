<?php


namespace JMBTechnologyLimited\HTMLIsAnEvent;


/**
 *
 * @link https://github.com/JMB-Technology-Limited/HTMLIsAnEvent
 * @license https://raw.github.com/JMB-Technology-Limited/HTMLIsAnEvent/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2015, JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class BothTest  extends \PHPUnit_Framework_TestCase {

	function testFile1() {

		$parser = new Parser(file_get_contents(__DIR__.DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."both1.html"), "http://example.com");

		$events = $parser->getEvents();

		$this->assertEquals(1, count($events));


		############################### Event

		$event1 = $events[0];


		$this->assertEquals("IndieWebCamp 2015",$event1->getTitle());
		$this->assertEquals(1, $event1->getUrlsCount());
		$this->assertEquals("http://indiewebcamp.com/2015",$event1->getUrls()[0]->getUrl());


		$this->assertNotNull($event1->getStart());
		$this->assertEquals("2015-07-11T16:30:00+00:00",$event1->getStart()->format("c"));
		$this->assertEquals("+00:00",$event1->getStart()->getTimezone()->getName());

		$this->assertNotNull($event1->getEnd());
		$this->assertEquals("2015-07-11T16:30:00+00:00",$event1->getEnd()->format("c"));
		$this->assertEquals("+00:00",$event1->getEnd()->getTimezone()->getName());

		$this->assertNull($event1->getDescriptionHtml());
		$this->assertNull($event1->getDescriptionText());

	}

}

