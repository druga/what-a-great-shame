function do_reboot
{
	$kaHnuK = gwmi win32_operatingsystem
	$kaHnuK.psbase.Scope.Options.EnablePrivileges = $true
	$kaHnuK.reboot()
}
function do_hibernate
{
	[Diagnostics.Process]::Start('shutdown','-h')
	$form.close()
}

$COMObject = new-object -comobject wscript.shell
if ($args -eq "reboot") {
$PopupWindow = $COMObject.popup("�� ������������� ������ ������������� Windows?",0,"������������ Windows",1)
} elseif ($args -eq "hibernate") {
$PopupWindow = $COMObject.popup("�� ������������� ������ ��������� Windows � ������ �����?",0,"������ ����� Windows",1)
}

if ($PopupWindow -eq 1) {
do_reboot
} elseif ($PopupWindow -eq 0) {
do_hibernate
}