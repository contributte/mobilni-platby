@echo off
%CD%\..\vendor\bin\tester.bat -w %CD%\MobilniPlatby -s -j 40 -log %CD%\tester.log
rmdir %CD%\tmp /Q /S