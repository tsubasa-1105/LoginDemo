@echo off

if "%1" == "" goto PARAM_ERROR

git init
git add .
git commit -m "first commit"
git remote add origin %1
git push -u origin master

echo Success!!
exit /B

:PARAM_ERROR
echo Param Error.
exit /B