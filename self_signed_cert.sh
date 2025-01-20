
perror()
{
   echo "error: $*" >&2
   exit 1
}

mkdir ca cert keys csr


if [ -f ca/rootCA.key ] ; then
    echo "CA already exists"
else
    openssl genrsa -out ca/rootCA.key 4096 
    openssl req -new -x509 -days 365 -key ca/rootCA.key -subj="/C=AT/ST=Austria/O=ACOSec/CN=ACOSec CA" -out ca/rootCA.crt 
fi
                                                                                                                                                      
if [ -f keys/nyanair-web.key ] ; then
    perror "key already exists"
else
    openssl req -newkey rsa:2048 -nodes -keyout keys/nyanair-web.key -subj="/C=AT/ST=Austria/O=ACOSec/CN=nyanair.example.com" -out csr/nyanair-web.csr
    openssl x509 -req -extfile <(printf "subjectAltName=DNS:*.example.com,DNS:nyanair.example.com") -days 365 -in csr/nyanair-web.csr -CA ca/rootCA.crt -CAkey ca/rootCA.key -CAcreateserial -out cert/nyanair-web.crt    
fi



