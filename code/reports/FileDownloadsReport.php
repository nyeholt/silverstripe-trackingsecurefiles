<?php

/**
 * Content secure files download listing
 * @package trackingsecurefiles
 * @subpackage reports
 */

class FileDownloadsReport extends SS_Report {

	function title() {
		return _t('FileDownloadsReport.FILE_DOWNLOADS',"File Downloads");
	}

	function description() {
		return _t('FileDownloadsReport.DESC_FILE_DOWNLOADS', 'List of all secured files that have been downloaded');
	}

	function columns() {
		return array(
			"Filename" => array('title' => 'Filename'),
			'Created' => array('title' => 'Time'),
			'UserID' => array('title' => 'User'),
			'By' => array(
				'title' => 'By',
				'formatting' => '".$getDownloader()."',
				'csvFormatting' => '".$getDownloader()."',
			),
			'Referer' => array('title' => 'Referrer'),
			'UserAgent' => array('title' => 'UserAgent'),
			'UserIP' => array('title' => 'IP Address'),
		);
	}

	/**
	 * Return the records that provides your report data.
	 */
	public function sourceRecords($params = null) {
		return FileDownloadRecord::get()->sort('Created', 'DESC');
	}
}
