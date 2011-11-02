# CodeIgniter Geolocations 2

This is a renewed geolocations library using php extension GeoIP and Maxmind's free geoip database (www.maxmind.com)

## Author

Barna Szalai / sz.b@subdesign.hu

## Version

2.0

## Pre-requirements

1. Install GeoIP php extension (http://www.php.net/manual/en/book.geoip.php)

## Installation

1. Download GeoIP.dat, GeoLiteCity.dat from http://geolite.maxmind.com/download/geoip/database/

2. Rename GeoLiteCity.dat to GeoIPCity.dat

3. Check the 'available' flag if it's 1 then .dat file installed to the correct path. If not you have to move the file(s):

		<?php print_r( geoip_db_get_all_info() ); ?>

4. Import sql file into your database

5. Copy the files in the appropriate folders
