docker build --tag certificationy_app docker/

docker stop certificationy_app_runtime
docker run --rm -t --name certificationy_app_runtime -d --mount type=bind,source="$(pwd)"/,target=/app certificationy_app php certificationy.php --training

clear

docker attach certificationy_app_runtime
