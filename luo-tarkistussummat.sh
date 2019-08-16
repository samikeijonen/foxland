#!/bin/bash
echo "Tuotetaan MD5-tarkistussummat..."
find  * -type f 2>/dev/null  -exec md5sum {} \; > md5sums-temp
cat md5sums-temp | sort -k 2 -f > tiedostot-`date +%Y%m%d`.md5
rm md5sums-temp
sed -i '/md5sums-temp/d' tiedostot-`date +%Y%m%d`.md5
