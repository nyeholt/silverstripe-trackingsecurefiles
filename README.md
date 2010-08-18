Tracking Secure Files
########################

Maintainer Contact
------------------
Marcus Nyeholt

<marcus (at) silverstripe (dot) com (dot) au>

Requirements
------------
SilverStripe 2.4.x
securefiles module from http://polemic.net.nz/svn/silverstripe/modules/SecureFiles/trunk/


Documentation
-------------

The Tracking Secure Files module adds the ability to record the download of a secure file.

The list of download occurrences can be viewed by navigating to a file in a secure
folder and viewing the list of downloads, or by navigating to the "Reports" section and
viewing the overall File Download report.

Quick Usage Overview
--------------------

Extract to the "trackingsecurefiles" directory. It is already configured to
override the default behaviour of the secure files module. 


Troubleshooting
---------------

The base securefiles module does throw a few PHP Notice errors - check
these if you're having trouble downloading files. 