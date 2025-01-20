
if [ $# -gt 0 ] ; then
	mysql -u root -h 127.0.0.1 -p nyandb < $1
else
	mysql -u root -h 127.0.0.1 -p nyandb
fi
