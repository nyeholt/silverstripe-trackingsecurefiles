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
class DownloadTrackable extends DataObjectDecorator {
    public function updateCMSFields($fields) {
		if ($this->owner->ClassName == 'File' || $this->owner->ClassName == 'Image') {
			$downloadsTab = $fields->findOrMakeTab('BottomRoot.'._t('DownloadTrackable.DOWNLOADTRACKINGTAB', 'Downloads'));

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

			$fields->addFieldToTab('BottomRoot.'._t('DownloadTrackable.DOWNLOADTRACKINGTAB', 'Downloads'), $tableField);
		}
	}
}