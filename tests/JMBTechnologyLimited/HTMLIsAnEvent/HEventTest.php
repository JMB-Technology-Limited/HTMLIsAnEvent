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


		############################### Event

		$event1 = $events[0];


		$this->assertEquals("IndieWebCamp 2014",$event1->getTitle());
		$this->assertEquals(5, $event1->getUrlsCount());
		$this->assertEquals("http://indiwebcamp.com/2014",$event1->getUrls()[0]->getUrl());
		$this->assertEquals("http://lanyrd.com/2014/indiewebcamp-2/",$event1->getUrls()[1]->getUrl());
		$this->assertEquals("http://plancast.com/p/lg3r",$event1->getUrls()[2]->getUrl());
		$this->assertEquals("http://indiewebcamp.com/",$event1->getUrls()[3]->getUrl());
		$this->assertEquals("http://twitter.com/indiewebcamp",$event1->getUrls()[4]->getUrl());


		$this->assertNotNull($event1->getStart());
		$this->assertEquals("2014-06-28T00:00:00+00:00",$event1->getStart()->format("c"));
		$this->assertEquals("UTC",$event1->getStart()->getTimezone()->getName());

		$this->assertNotNull($event1->getEnd());
		$this->assertEquals("2014-06-29T00:00:00+00:00",$event1->getEnd()->format("c"));
		$this->assertEquals("UTC",$event1->getEnd()->getTimezone()->getName());

		$this->assertNull($event1->getDescriptionHtml());
		$this->assertNull($event1->getDescriptionText());

		############################### Event

		$event2 = $events[1];

		$this->assertEquals("IndieWebCampSF",$event2->getTitle());
		$this->assertEquals(2, $event2->getUrlsCount());
		$this->assertEquals("http://indiewebcamp.com/2014/SF",$event2->getUrls()[0]->getUrl());
		$this->assertEquals("irc://irc.freenode.net/indiewebcamp",$event2->getUrls()[1]->getUrl());

		$this->assertNotNull($event2->getStart());
		$this->assertEquals("2014-03-07T10:00:00-08:00",$event2->getStart()->format("c"));
		$this->assertEquals("-08:00",$event2->getStart()->getTimezone()->getName());
		
		$this->assertNotNull($event2->getEnd());
		$this->assertEquals("2014-03-08T18:00:00-08:00",$event2->getEnd()->format("c"));
		$this->assertEquals("-08:00",$event2->getEnd()->getTimezone()->getName());

		$this->assertEquals("The very first IndieWebCamp in San Francisco. Join us in San Francisco for two days of a BarCamp-style gathering of web creators building and sharing open web technologies to empower users to own their own identities & content, and advance the state of the indie web.",$event2->getDescriptionHtml());
		$this->assertEquals("The very first IndieWebCamp in San Francisco. Join us in San Francisco for two days of a BarCamp-style gathering of web creators building and sharing open web technologies to empower users to own their own identities & content, and advance the state of the indie web.",$event2->getDescriptionText());

		############################### Event

		$event3 = $events[2];


		$this->assertEquals("Homebrew Website Club",$event3->getTitle());
		$this->assertEquals(1, $event3->getUrlsCount());
		$this->assertEquals("http://indiewebcamp.com/events/2014-01-15-homebrew-website-club",$event3->getUrls()[0]->getUrl());



		$this->assertNotNull($event3->getStart());
		$this->assertEquals("2014-01-15T18:30:00-08:00",$event3->getStart()->format("c"));
		$this->assertEquals("-08:00",$event3->getStart()->getTimezone()->getName());

		$this->assertNotNull($event3->getEnd());
		$this->assertEquals("2014-01-15T19:30:00-08:00",$event3->getEnd()->format("c"));
		$this->assertEquals("-08:00",$event3->getEnd()->getTimezone()->getName());

		$this->assertEquals("Are you building your own website? Indie reader? Personal publishing web app? Or some other digital magic-cloud proxy? If so, come on by and join a gathering of people with likeminded interests. Bring your friends that want to start a personal web site. Exchange information, swap ideas, talk shop, help work on a project, whatever... ",$event3->getDescriptionHtml());
		$this->assertEquals("Are you building your own website? Indie reader? Personal publishing web app? Or some other digital magic-cloud proxy? If so, come on by and join a gathering of people with likeminded interests. Bring your friends that want to start a personal web site. Exchange information, swap ideas, talk shop, help work on a project, whatever...",$event3->getDescriptionText());



	}


	function testFile2() {

		$parser = new Parser(file_get_contents(__DIR__.DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."hevent2.html"), "http://example.com");

		$events = $parser->getEvents();

		$this->assertEquals(1, count($events));


		############################### Event

		$event1 = $events[0];


		$this->assertEquals("Homebrew Website Club",$event1->getTitle());
		$this->assertEquals(2, $event1->getUrlsCount());
		$this->assertEquals("http://indiewebcamp.com/events/2015-07-15-homebrew-website-club",$event1->getUrls()[0]->getUrl());
		$this->assertEquals("https://aaronparecki.com/events/2015/07/15/1/homebrew-website-club",$event1->getUrls()[1]->getUrl());


		$this->assertNotNull($event1->getStart());
		$this->assertEquals("2015-07-15T17:30:00-07:00",$event1->getStart()->format("c"));
		$this->assertEquals("-07:00",$event1->getStart()->getTimezone()->getName());

		$this->assertNotNull($event1->getEnd());
		$this->assertEquals("2015-07-15T19:30:00-07:00",$event1->getEnd()->format("c"));
		$this->assertEquals("-07:00",$event1->getEnd()->getTimezone()->getName());

		$this->assertNull($event1->getDescriptionHtml());
		$this->assertNull($event1->getDescriptionText());

	}




}

