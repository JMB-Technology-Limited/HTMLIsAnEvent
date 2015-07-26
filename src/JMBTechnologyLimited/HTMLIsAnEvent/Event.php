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

	protected $urls = array();

	protected $start;

	protected $end;

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
	 * @return mixed
	 */
	public function getUrls()
	{
		return $this->urls;
	}

	/**
	 * @return integer
	 */
	public function getUrlsCount()
	{
		return count($this->urls);
	}


	public function addUrl(URL $url) {
		$this->urls[] = $url;
	}

	/**
	 * @param mixed $start
	 */
	public function setStart($start)
	{
		$this->start = $start;
	}

	/**
	 * @return mixed
	 */
	public function getStart()
	{
		return $this->start;
	}

	/**
	 * @param mixed $end
	 */
	public function setEnd($end)
	{
		$this->end = $end;
	}

	/**
	 * @return mixed
	 */
	public function getEnd()
	{
		return $this->end;
	}




}

