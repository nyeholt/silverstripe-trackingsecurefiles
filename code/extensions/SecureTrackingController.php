<?php

/**
 * @author marcus
 */
class SecureTrackingController extends Extension {
    
	public function onBeforeSendFile($file) {
		// check to make sure this is the actual file and not just a rendition... if that matters?
		$downloadRecord = new FileDownloadRecord();
		// store the full filename for now
		$url = array_key_exists('url', $_GET) ? $_GET['url'] : $_SERVER['REQUEST_URI'];
		// check if it's a resampled file
		if (strpos($url, '_resampled') !== false) {
			// ignore it
			return;
		}
		$file_path = Director::makeRelative($url);
		$downloadRecord->Filename = $file_path ? $file_path : $file->getFilename();
		$downloadRecord->FileID = $file->ID;
		$downloadRecord->write();
	}
}
