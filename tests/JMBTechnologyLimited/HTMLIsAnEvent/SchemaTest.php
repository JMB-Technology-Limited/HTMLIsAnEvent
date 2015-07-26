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

		############################### Event

		$event = $events[0];


		$this->assertEquals("Indiewebcamp Edinburgh",$event->getTitle());

		$this->assertNotNull($event->getStart());
		$this->assertEquals("2015-07-25T10:00:00+01:00",$event->getStart()->format("c"));
		$this->assertEquals("+01:00",$event->getStart()->getTimezone()->getName());

		$this->assertNotNull($event->getEnd());
		$this->assertEquals("2015-07-26T18:00:00+01:00",$event->getEnd()->format("c"));
		$this->assertEquals("+01:00",$event->getEnd()->getTimezone()->getName());

		$this->assertEquals("IndieWebCamp is a 2-day creator camp focused on growing the independent web.  The importance of owning your data is getting more awareness. To grow it and help people getting started, we&#039;re meeting for a bar-camp like collaboration in Edinburgh for two days of brainstorming, working, teaching, helping. Join us in Edinburgh and learn how to use open web technologies to empower and – maybe more importantly – encourage users to own their own content and identities.  Code of Conduct: https://indiewebcamp.com/code-of-conduct", $event->getDescriptionText());


		$this->assertEquals(" IndieWebCamp is a 2-day creator camp focused on growing the independent web.<br /> <br /> The importance of owning your data is getting more awareness. To grow it and help people getting started, we&#039;re meeting for a bar-camp like collaboration in Edinburgh for two days of brainstorming, working, teaching, helping.<br /> Join us in Edinburgh and learn how to use open web technologies to empower and – maybe more importantly – encourage users to own their own content and identities. <p> Code of Conduct:<br /> <a href=\"https://indiewebcamp.com/code-of-conduct\" target=\"_blank\">https://indiewebcamp.com/code-of-conduct</a> </p> ", $event->getDescriptionHtml());


	}



	function testFile2() {

		$parser = new Parser(file_get_contents(__DIR__.DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."schema2.html"), "http://example.com");

		$events = $parser->getEvents();

		$this->assertEquals(2, count($events));


		############################### Event

		$event1 = $events[0];


		$this->assertEquals("TechMeetup Edinburgh",$event1->getTitle());
		$this->assertEquals(1, $event1->getUrlsCount());
		$this->assertEquals("/event/2595-techmeetup-edinburgh",$event1->getUrls()[0]->getUrl());

		$this->assertNotNull($event1->getStart());
		$this->assertEquals("2015-07-08T18:30:00+01:00",$event1->getStart()->format("c"));
		$this->assertEquals("+01:00",$event1->getStart()->getTimezone()->getName());


		$this->assertNull($event1->getEnd());

		$this->assertEquals("Welcoming anyone involved or working in technology.  TechMeetup is a monthly excuse for developers and the tech community around Scotland to meet up and learn new stuff from each other. No name badges, no sales pitches, just informative presentations from your peers and a chance to meet some of the tech community around you.  We&#039;re not centred around specific languages, technologies or disciplines; we believe there&#039;s stuff to learn from mixing everyone together. There&#039;s no cost to attend, and food and drink are provided.", $event1->getDescriptionText());

		$this->assertEquals("Welcoming anyone involved or working in technology.<br /> <br /> TechMeetup is a monthly excuse for developers and the tech community around Scotland to meet up and learn new stuff from each other. No name badges, no sales pitches, just informative presentations from your peers and a chance to meet some of the tech community around you.<br /> <br /> We&#039;re not centred around specific languages, technologies or disciplines; we believe there&#039;s stuff to learn from mixing everyone together. There&#039;s no cost to attend, and food and drink are provided.", $event1->getDescriptionHtml());

		############################### Event

		$event2 = $events[1];


		$this->assertEquals("TechMeetup Edinburgh",$event2->getTitle());
		$this->assertEquals(1, $event2->getUrlsCount());
		$this->assertEquals("/event/2596-techmeetup-edinburgh",$event2->getUrls()[0]->getUrl());
		$this->assertNotNull($event2->getStart());
		$this->assertEquals("2015-08-12T18:30:00+01:00",$event2->getStart()->format("c"));
		$this->assertEquals("+01:00",$event2->getStart()->getTimezone()->getName());
		
		$this->assertNull($event2->getEnd());


		$this->assertEquals("Welcoming anyone involved or working in technology.  TechMeetup is a monthly excuse for developers and the tech community around Scotland to meet up and learn new stuff from each other. No name badges, no sales pitches, just informative presentations from your peers and a chance to meet some of the tech community around you.  We&#039;re not centred around specific languages, technologies or disciplines; we believe there&#039;s stuff to learn from mixing everyone together. There&#039;s no cost to attend, and food and drink are provided.", $event2->getDescriptionText());


		$this->assertEquals("Welcoming anyone involved or working in technology.<br /> <br /> TechMeetup is a monthly excuse for developers and the tech community around Scotland to meet up and learn new stuff from each other. No name badges, no sales pitches, just informative presentations from your peers and a chance to meet some of the tech community around you.<br /> <br /> We&#039;re not centred around specific languages, technologies or disciplines; we believe there&#039;s stuff to learn from mixing everyone together. There&#039;s no cost to attend, and food and drink are provided.", $event2->getDescriptionHtml());
	}



}

