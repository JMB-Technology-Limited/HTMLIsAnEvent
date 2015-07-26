<?php


namespace JMBTechnologyLimited\HTMLIsAnEvent;


/**
 *
 * @link https://github.com/JMB-Technology-Limited/HTMLIsAnEvent
 * @license https://raw.github.com/JMB-Technology-Limited/HTMLIsAnEvent/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2015, JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class Event {


	protected $title;

	protected $url;


	/**
	 * @param mixed $title
	 */
	public function setTitle($title)
	{
		$this->title = trim($title);
	}

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param mixed $url
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * @return mixed
	 */
	public function getUrl()
	{
		return $this->url;
	}





}

