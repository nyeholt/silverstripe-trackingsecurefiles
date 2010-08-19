<?php
/* 
 * 
All code covered by the BSD license located at http://silverstripe.org/bsd-license/
 */

/**
 * A data object used to record an occurence of a file being downloaded by a
 * user in a secure environment.
 *
 * @author marcus@silverstripe.com.au
 */
class FileDownloadRecord extends DataObject {
    public static $db = array(
		'Filename' => 'Varchar(255)',
		'UserIP' => 'Varchar(32)',
		'Referer' => 'Varchar(255)',
		'UserAgent' => 'Varchar(255)',
	);

	public static $has_one = array(
		'User' => 'Member',
		'File' => 'File',
		'Page' => 'SiteTree',
	);

	protected function onBeforeWrite() {
		parent::onBeforeWrite();
		if (!$this->UserIP) {
			$this->UserIP = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		}
		if (!$this->Referer) {
			$this->Referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		}
		if (!$this->UserID) {
			$this->UserID = Member::currentUserID();
		}
		if (!$this->UserAgent) {
			$this->UserAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
		}
	}

	public function Downloader() {
		$downloader = $this->User();
		if ($downloader) {
			return $downloader->getName();
		}
	}
}