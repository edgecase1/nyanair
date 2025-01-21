

if [ ! -f ../ca/rootCA.key ] ; then
    echo "CA doesn't exist"
fi
                                                                                                                                                      
openssl req -newkey rsa:2048 -nodes -keyout src/key.pem -subj="/C=AT/ST=Austria/O=ACOSec/CN=checkin.example.com" -out checkin.csr
openssl x509 -req -extfile <(printf "subjectAltName=DNS:checkin.example.com,DNS:checkin.example.org") -days 365 -in checkin.csr -CA ../ca/rootCA.crt -CAkey ../ca/rootCA.key -CAcreateserial -out src/cert.pem    


