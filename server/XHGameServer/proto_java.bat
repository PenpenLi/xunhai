::protoc.exe -I=proto������Ŀ¼ --java_out=java�����Ŀ¼ proto������Ŀ¼��������proto�ļ�
::protoc.exe --proto_path=[proto_root] --java_out=[save_root] [*.proto]
::rem ��ʽ1...
::protoc.exe --proto_path=. --java_out=. BS_GC.proto
::rem ��ʽ2...
::protoc.exe -I=. --java_out=pb BS_GC.proto

@echo off
echo ��������java�� protocal buffer Э��

echo ��ʼ�����Եȡ�������
echo ..

set ProtocalFolderName=proto
set OutProtocalFolderName=.\src
for /f "delims=\" %%a in ('dir /b /a-d /o-d "%ProtocalFolderName%\*.proto"') do (
  echo ���� %%a
  echo %ProtocalFolderName%\%%a
  protoc.exe --proto_path=%ProtocalFolderName% --java_out=%OutProtocalFolderName% %ProtocalFolderName%\%%a
)

echo ..
echo ���!
pause & exit /b