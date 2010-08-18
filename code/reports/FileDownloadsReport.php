<?php

/**
 * Content side-report listing pages with broken links
 * @package cms
 * @subpackage content
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
			"Filename" => 'Filename',
			'Created' => 'Time',
			'By' => array(
				'title' => 'By',
				'formatting' => '".$Downloader()."',
			),
			'Referer' => 'Referrer',
			'UserIP' => 'IP Address',
		);
	}
	
	/**
	 * Return the {@link SQLQuery} that provides your report data.
	 */
	function sourceQuery($params) {
		$dummy = new FileDownloadRecord();
		$query = $dummy->buildSQL();
		$query->orderby('Created DESC');
		return $query;
	}
}
