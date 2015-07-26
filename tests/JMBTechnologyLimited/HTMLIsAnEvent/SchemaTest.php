<?php


namespace JMBTechnologyLimited\HTMLIsAnEvent;


/**
 *
 * @link https://github.com/JMB-Technology-Limited/HTMLIsAnEvent
 * @license https://raw.github.com/JMB-Technology-Limited/HTMLIsAnEvent/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2015, JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class SchemaTest  extends \PHPUnit_Framework_TestCase {



	function testFile1() {

		$parser = new Parser(file_get_contents(__DIR__.DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."schema1.html"), "http://example.com");

		$events = $parser->getEvents();

		$this->assertEquals(1, count($events));

		$event = $events[0];


		$this->assertEquals("Indiewebcamp Edinburgh",$event->getTitle());






	}



	function testFile2() {

		$parser = new Parser(file_get_contents(__DIR__.DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."schema2.html"), "http://example.com");

		$events = $parser->getEvents();

		$this->assertEquals(2, count($events));




		$event1 = $events[0];


		$this->assertEquals("TechMeetup Edinburgh",$event1->getTitle());
		$this->assertEquals(1, $event1->getUrlsCount());
		$this->assertEquals("/event/2595-techmeetup-edinburgh",$event1->getUrls()[0]->getUrl());



		$event2 = $events[1];


		$this->assertEquals("TechMeetup Edinburgh",$event2->getTitle());
		$this->assertEquals(1, $event2->getUrlsCount());
		$this->assertEquals("/event/2596-techmeetup-edinburgh",$event2->getUrls()[0]->getUrl());






	}



}

