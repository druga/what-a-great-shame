@echo off
@copy plugins\vc_main.asi* backup\
@del plugins\vc_main.asi*
@copy backup\Trainertbogt.asi .
@copy backup\launchvcr.exe .
@attrib +R trainertbogt.asi
@launchvcr
