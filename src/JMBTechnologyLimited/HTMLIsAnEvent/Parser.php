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

		$idsOfRootElements = array();

		foreach($dom->find('[itemtype="http://schema.org/Event"]') as $node) {

			$idsOfRootElements[] = $node->id();

			$event = new Event();

			//$places = $node->find('[itemtype="http://schema.org/Place"]');

			$nameMetas = $node->find('meta[itemprop="name"]');
			if ($nameMetas->count() > 0) {
				$event->setTitle(html_entity_decode($nameMetas->getAttribute("content")));
			} else {
				$nameContents = $node->find('[itemprop="name"]');
				if ($nameContents->count() > 0) {
					$event->setTitle(html_entity_decode($nameContents[0]->text(true)));
				}
			}

			$urlContents = $node->find('a[itemprop="url"]');
			if ($urlContents->count() > 0) {
				foreach($urlContents as $urlContent) {
					$event->addUrl(new URL($this->getAbsoluteURL(html_entity_decode($urlContent->getAttribute("href")))));
				}
			}

			$startMetas = $node->find('meta[itemprop="startDate"]');
			if ($startMetas->count() > 0) {
				$event->setStart(new \DateTime($startMetas[0]->getAttribute("content"), new \DateTimeZone("UTC")));
			} else {
				$startContents = $node->find('time[itemprop="startDate"]');
				if ($startContents->count() > 0) {
					$event->setStart(new \DateTime($startContents[0]->getAttribute("datetime"), new \DateTimeZone("UTC")));
				}
			}

			$endMetas =  $node->find('meta[itemprop="endDate"]');
			if ($endMetas->count() > 0) {
				$event->setEnd(new \DateTime($startMetas[0]->getAttribute("content"), new \DateTimeZone("UTC")));
			} else {
				$endContents = $node->find('time[itemprop="endDate"]');
				if ($endContents->count() > 0) {
					$event->setEnd(new \DateTime($endContents[0]->getAttribute("datetime"), new \DateTimeZone("UTC")));
				}
			}

			$descriptionContents = $node->find('p[itemprop="description"]');
			if ($descriptionContents->count() > 0) {
				$event->setDescriptionText(html_entity_decode($descriptionContents[0]->text(true)));
				$event->setDescriptionHTML(html_entity_decode($descriptionContents[0]->innerHtml()));
			}

			$this->events[] = $event;

		}



		foreach($dom->find('.h-event') as $node) {

			if (!in_array($node->id(), $idsOfRootElements)) {

				$event = new Event();

				$locations = $node->find(".p-location");
				foreach($locations as $location) {
					$location->getParent()->removeChild($location->id());
				}


				$nameContents = $node->find('.p-name');
				if ($nameContents->count() > 0) {
					$event->setTitle(html_entity_decode($nameContents[0]->text(true)));
				}

				$urlContents = $node->find('.u-url a, a.u-url');
				if ($urlContents->count() > 0) {
					foreach($urlContents as $urlContent) {
						$event->addUrl(new URL($this->getAbsoluteURL(html_entity_decode($urlContent->getAttribute("href")))));
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

				$endContents = $node->find('time.dt-end');
				if ($endContents->count() > 0) {
					if ($endContents[0]->getAttribute("datetime")) {
						$event->setEnd(new \DateTime($endContents[0]->getAttribute("datetime"), new \DateTimeZone("UTC")));
					} else if ($endContents[0] instanceof Dom\HtmlNode && $endContents[0]->text(true)) {
						$event->setEnd(new \DateTime($endContents[0]->text(true), new \DateTimeZone("UTC")));
					}
				}

				$descriptionContents = $node->find('.p-description');
				if ($descriptionContents->count() > 0) {
					$event->setDescriptionText(html_entity_decode($descriptionContents[0]->text(true)));
					$event->setDescriptionHTML(html_entity_decode($descriptionContents[0]->innerHtml()));
				}


				$this->events[] = $event;

			}
		}




	}


	/**
	 * @return array
	 */
	public function getEvents()
	{
		return $this->events;
	}


	protected function getAbsoluteURL($url) {

		if (substr($url, 0, 1) == '/') {

			$bits =  explode("/", $this->url);
			return implode("/", array_slice($bits, 0 ,3)). $url;

		}


		return $url;
	}
}


