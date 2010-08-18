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
		'Referer' => 'Varchar(255)'
	);

	public static $has_one = array(
		'User' => 'Member',
		'File' => 'File',
	);

	public function Downloader() {
		$downloader = $this->User();
		if ($downloader) {
			return $downloader->getName();
		}
	}
}