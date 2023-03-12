Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "D:\OpenServer\domains\chat.loc\cron.bat" & Chr(34), 0
Set WinScriptHost = Nothing