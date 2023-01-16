BASEDIR=$(dirname "$0")
sudo docker network create --subnet 173.30.0.0/16 kpl_net
sudo docker build -t kpl/server ${BASEDIR}/apache

sudo docker rm -f kpl.local
sudo docker rm -f mysql.local

sudo docker run -d --name kpl.local --ip=173.30.0.2 --net kpl_net -itd -v /home/devs/integracoes/kplgoogle:/var/www/html kpl/server

sudo docker run -d --name mysql.local --ip=173.30.0.3  --net kpl_net -v /var/opt/mysql/:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=toor -d mysql --default-authentication-plugin=mysql_native_password

