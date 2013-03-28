@echo off
@attrib -R trainertbogt.asi
@del trainertbogt.asi
@copy backup\vc_main.asi* plugins\
@copy /Y LaunchVCR_new.exe.backup LaunchVCR.exe
@launchvcr
