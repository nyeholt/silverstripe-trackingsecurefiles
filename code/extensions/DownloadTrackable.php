<?php
/* 
 * 
All code covered by the BSD license located at http://silverstripe.org/bsd-license/
 */

/**
 * Description
 *
 * @author marcus@silverstripe.com.au
 */
class DownloadTrackable extends DataExtension{

    public function updateCMSFields(FieldList $fields) {

		if ($this->owner->ClassName == 'File' || $this->owner->ClassName == 'Image') {
			$downloadsTab = $fields->findOrMakeTab('Root.'._t('DownloadTrackable.DOWNLOADTRACKINGTAB', 'Downloads'));

			$showfields = array(
				'Filename' => 'Filename',
				'Created' => 'Downloaded',
				'By' => 'By',
			);

			$tableField = new TableListField(
				'Downloads', 'FileDownloadRecord',
				$showfields, '"FileID"=' . (int) $this->owner->ID,
				'Created DESC'
			);

			$tableField->setFieldFormatting(array(
				'By' => '".$Downloader()."'
			));

			$total = DB::query(sprintf(
				"SELECT COUNT(*) FROM \"%s\" WHERE \"%s\" = %d",
				'FileDownloadRecord',
				'FileID',
				(int) $this->owner->ID
			))->value();

			$tf = new TextField('DownloadTotal', _t('DownloadTrackable.TOTAL', 'Total'), $total);
			$tf = $tf->performReadonlyTransformation();
			$fields->addFieldToTab('Root.'._t('DownloadTrackable.DOWNLOADTRACKINGTAB', 'Downloads'), $tf);
			$fields->addFieldToTab('Root.'._t('DownloadTrackable.DOWNLOADTRACKINGTAB', 'Downloads'), $tableField);
		}
	}

	public function onAccessGranted() {
		// check to make sure this is the actual file and not just a rendition... if that matters?
		$o = $this->owner;
		
		$downloadRecord = new FileDownloadRecord();
		// store the full filename for now
		$url = array_key_exists('url', $_GET) ? $_GET['url'] : $_SERVER['REQUEST_URI'];
		// check if it's a resampled file
		if (strpos($url, '_resampled/AssetLibraryPreview')) {
			// ignore it
			return;
		}
		$file_path = Director::makeRelative($url);
		$downloadRecord->Filename = $file_path ? $file_path : $this->owner->getFilename();
		$downloadRecord->FileID = $this->owner->ID;
		$downloadRecord->write();
	}
}