<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Booking Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .remove-btn {
            color: #dc3545;
            cursor: pointer;
        }

        .add-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .promotion {
            border: 1px solid silver;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="form-header">Book Your Passengers</h2>
        <div class="promotion">
        <?php include(app_path().'/includes/promotion.php'); ?>
        <script src="/promotion.js"></script>
        </div>
        <form id="passengerForm" action="/book" method="post">
            @csrf
            <input type="hidden" name="from" value={{$from}}>
            <input type="hidden" name="to" value={{$to}}>
            <input type="hidden" name="departure" value={{$departure}}>
            <div class="passenger-group mb-3">
                    <h5>Payment details</h5>
                    <div class="mb-3">
                        <label for="name1" class="form-label">Name (for the payment)</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">email (for the payment)</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="address">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="city">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="country">
                    </div>
                </div>
            <div id="passengerList">
            </div>
            <div class="add-btn">
                <button type="button" id="addPassenger" class="btn btn-primary">Add Passenger</button>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Pay</button>
            </div>
        </form>
    </div>

    <script>
        function GetURLParameter(sParam)
        {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) 
            {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) 
                {
                    return sParameterName[1];
                }
            }
        }

        let i = 1;
        const maxPassengerCount = 3;

        function add() {
                if(i >= maxPassengerCount){
                    return;
                }
                if(i == 1){
                    name = $("#name").val();
                } else {
                    name = "";
                }
                const passengerHTML = `
                    <div class="passenger-group mb-3">
                        <h5>Passenger ${i} <span class="remove-btn"><i class="fas fa-times-circle"></i></span></h5>
                        <div class="mb-3">
                            <label for="passengername${i}" class="form-label">Name</label>
                            <input type="text" class="form-control" id="passengername${i}" name="passengername[]" value="${name}" placeholder="Enter name">
                        </div>
                        <div class="mb-3">
                            <label for="birthday${i}" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthday${i}" name="birthday[]" placeholder="Enter birthday">
                        </div>
                        <div class="mb-3">
                            <label for="passport${i}" class="form-label">Passport</label>
                            <input type="text" class="form-control" id="passport${i}" name="passport[]" placeholder="Enter name">
                        </div>
                    </div>
                `;

                $("#passengerList").append(passengerHTML);
                i++; // X
        }

        $(document).ready(function () {

            $("#addPassenger").click(add);

            $(document).on("click", ".remove-btn", function () {
                $(this).closest(".passenger-group").remove();
                passengerCount--;
            });

            passengerCount = GetURLParameter("passengercount");

            if(passengerCount >= maxPassengerCount){
                passengerCount = maxPassengerCount;
                }
            for(x=1;x<=passengerCount;x++) {
                console.log(i);
                add();
            }
                
        });

        $('#name').on('change', function () {
            var pass_name_fields = $("[name='passengername[]']");
            if(pass_name_fields.length >= 1 && ! $(pass_name_fields.get(0)).val()) {
                $(pass_name_fields.get(0)).val($('#name').val()); 
            }
        });
    </script>
</body>
</html>
