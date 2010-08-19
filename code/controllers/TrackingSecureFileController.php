<?php
/* 
 * 
All code covered by the BSD license located at http://silverstripe.org/bsd-license/
 */

/**
 * A controller for handling secured files that also tracks who downloaded it and when
 *
 * @author marcus
 */
class TrackingSecureFileController extends SecureFileController {

	/**
	 * Overridden to track the actual downloaded file
	 *
	 * @param File $file
	 * @param String $alternate_path
	 * @return
	 */
    function fileFound(File $file, $alternate_path = null) {
		$downloadRecord = new FileDownloadRecord();
		// store the full filename for now
		$downloadRecord->Filename = $alternate_path ? $alternate_path : $file->getFilename();

		$downloadRecord->FileID = $file->ID;
		
		$downloadRecord->write();
		
		return parent::fileFound($file, $alternate_path);
	}
}