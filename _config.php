<?php

// To enable, add the following to your mysite/_config.php
// essentially, overridding what the securefiles module already provides. 
/*
Director::addRules(60, array(ASSETS_DIR . '/$Action' => 'TrackingSecureFileController'));
*/
DataObject::add_extension('File', 'DownloadTrackable');
SS_Report::register('ReportAdmin', 'FileDownloadsReport');

Director::addRules(60, array(
	ASSETS_DIR . '/$Action' => 'TrackingSecureFileController'
));
