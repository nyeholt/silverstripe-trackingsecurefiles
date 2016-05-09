<?php
/**
 * @author marcus@silverstripe.com.au
 */
class DownloadTrackable extends DataExtension {

    public function updateCMSFields(FieldList $fields) {

		if (!($this->owner instanceof Folder)) {
			$showfields = array(
				'Filename' => 'Filename',
				'Created' => 'At time',
				'Downloader' => 'Downloader',
			);
            
            $records = FileDownloadRecord::get()->filter(array(
                'FileID'    => $this->owner->ID
            ));
            
            $config = GridFieldConfig_RecordViewer::create();
            $colums = $config->getComponentByType('GridFieldDataColumns')->setDisplayFields($showfields);
            
            $grid = GridField::create('Downloads', 'Recorded downloads', $records, $config);

            $total = $records->count();
            
			$tf = TextField::create('DownloadTotal', _t('DownloadTrackable.TOTAL', 'Total'), $total);
			$tf = $tf->performReadonlyTransformation();
			$fields->addFieldToTab('Root.'._t('DownloadTrackable.DOWNLOADTRACKINGTAB', 'Downloads'), $tf);
			$fields->addFieldToTab('Root.'._t('DownloadTrackable.DOWNLOADTRACKINGTAB', 'Downloads'), $grid);
		}
	}

}