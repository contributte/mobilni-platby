@echo off
%CD%\..\vendor\bin\tester.bat -w %CD%\MobilniPlatby -s -j 40 -log %CD%\mobilniplatby.log
rmdir %CD%\tmp /Q /S