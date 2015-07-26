<?php


namespace JMBTechnologyLimited\HTMLIsAnEvent;

use PHPHtmlParser\Dom;

/**
 *
 * @link https://github.com/JMB-Technology-Limited/HTMLIsAnEvent
 * @license https://raw.github.com/JMB-Technology-Limited/HTMLIsAnEvent/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2015, JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class Parser {


	protected $html;

	protected $url;

	protected $events = array();

	function __construct($html, $url)
	{
		$this->html = $html;
		$this->url = $url;

		$dom = new Dom();
		$dom->load($html, array( 'strict' => false ));

		foreach($dom->find('div[itemtype="http://schema.org/Event"], li[itemtype="http://schema.org/Event"]') as $node) {

			$event = new Event();


			$nameMetas = $node->find('meta[itemprop="name"]');
			if ($nameMetas) {
				$event->setTitle(html_entity_decode($nameMetas->getAttribute("content")));
			}

			$nameContents = $node->find('div[itemprop="name"]');
			if ($nameContents->count() > 0) {
				$event->setTitle(html_entity_decode($nameContents[0]->text(true)));
			}

			$urlContents = $node->find('a[itemprop="url"]');
			if ($urlContents->count() > 0) {
				foreach($urlContents as $urlContent) {
					$event->addUrl(new URL(html_entity_decode($urlContent->getAttribute("href"))));
				}
			}

			$startContents = $node->find('time[itemprop="startDate"]');
			if ($startContents->count() > 0) {
				$event->setStart(new \DateTime($startContents[0]->getAttribute("datetime"), new \DateTimeZone("UTC")));
			}


			$this->events[] = $event;

		}



		foreach($dom->find('.h-event') as $node) {

			$event = new Event();

			$nameContents = $node->find('.p-name');
			if ($nameContents->count() > 0) {
				$event->setTitle(html_entity_decode($nameContents[0]->text(true)));
			}

			$urlContents = $node->find('.u-url a, a.u-url');
			if ($urlContents->count() > 0) {
				foreach($urlContents as $urlContent) {
					$event->addUrl(new URL(html_entity_decode($urlContent->getAttribute("href"))));
				}
			}

			$startContents = $node->find('time.dt-start');
			if ($startContents->count() > 0) {
				if ($startContents[0]->getAttribute("datetime")) {
					$event->setStart(new \DateTime($startContents[0]->getAttribute("datetime"), new \DateTimeZone("UTC")));
				} else if ($startContents[0] instanceof Dom\HtmlNode && $startContents[0]->text(true)) {
					$event->setStart(new \DateTime($startContents[0]->text(true), new \DateTimeZone("UTC")));
				}
			}


			$this->events[] = $event;

		}




	}


	/**
	 * @return array
	 */
	public function getEvents()
	{
		return $this->events;
	}

}


