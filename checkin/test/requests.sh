set -e errexit
set -x

PROXY="--proxy http://127.0.0.1:8080"
# $1=url, $2 post
request()
{
    echo -e -n "\n-----\n"
    curl $PROXY -X GET -w "\n$1 %{http_code}" -s -o - $1 2>&1   
}

ENDPOINT="http://test:5000"

#?document_type=Booking&document_number=MP2417879&surname=Kugler&Names=Reinhard&Date_of_birth=26/04/86&sex=male&nationality=AUT&personal_numer=2343446456456P23&issuing_country=AUT&expiration=05/02/32

# healthcheck
request "$ENDPOINT/healthcheck"

# passport document_nr and surname
request "$ENDPOINT/bookings?document_type=Passport&surname=Kugler&document_number=J123123C"
request "$ENDPOINT/bookings?document_type=Passport&surname=Kugler'&document_number=J123123C"
request "$ENDPOINT/bookings?document_type=Booking&document_number=MP2417879&surname=Kugler&Names=Reinhard&Date_of_birth=26/04/86&sex=male&nationality=AUT&personal_numer=2343446456456P23&issuing_country=AUT&expiration=05/02/32"

# bookingref booking_code and surname

# surname and birthday
request "$ENDPOINT/bookings?surname=Kugler&Date_of_birth=26/04/86"

# sqli name
#request "$ENDPOINT/bookings?document_type=Passport&document_number=MP2417879&surname=ESQUEL%27&Names=Reinhard&Date_of_birth=26/04/86&sex=male&nationality=AUT&personal_numer=2343446456456P23&issuing_country=AUT&expiration=05/02/32"

