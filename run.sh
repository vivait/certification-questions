docker build --tag certificationy_app .

docker stop certificationy_app_runtime
docker run --rm -t --name certificationy_app_runtime -d certificationy_app php certificationy.php --training

clear

docker attach certificationy_app_runtime

#--mount type=bind,source="$(pwd)"/,target=/app
#
