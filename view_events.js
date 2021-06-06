$.ajax({
    url: "view_events.php",
    type: 'GET',
    dataType: 'json',
    success: function(res) {
        for (var i = 0; i < 240; i++) {
            // Get a reference to the table
            if (res[i] !== undefined) {
                var tableRef = document.getElementById("TableA");

                // Insert a row in the table at row index 0
                var newRow   = tableRef.insertRow(0);


                // Insert a cells in the rows

                var event = newRow.insertCell(0);
                event.innerHTML = res[i][0].event_name;
                var eventId = newRow.insertCell(1);
                eventId.innerHTML = res[i][0].event_id;
                var boton  = newRow.insertCell(2);
                var moreDetails = newRow.insertCell(3);

                //creates a new delete button for each  event and sets all its id to the button id
                var newButton1  = document.createElement("BUTTON");
                newButton1.id = res[i][0].event_id;
                newButton1.innerHTML = "Delete";
                boton.appendChild(newButton1);
                //creates a new edit button for each  event and sets all its id to the button id
                var newButton2 = document.createElement("BUTTON");
                newButton2.id = res[i][0].event_id;
                newButton2.innerHTML = "More Details";
                moreDetails.appendChild(newButton2);
                // event listener for each button
                newButton1.addEventListener("click", function(e) {
                    $.ajax({
                        url: "delete_event.php",
                        type: 'POST',
                        data: "event_id=" + this.id,
                        success: function(res) {
                            location.reload();
                        }
                    });
                });
                // event listener for each button
                newButton2.addEventListener("click", function(e) {
                    localStorage.setItem("event_id", this.id)
                    let event_id = localStorage.getItem("event_id");
                    location.replace("more_details.html");
                });

            }

        }
        $(document).ready(function() {
            $('#search_form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'get_event.php',
                    data: $(this).serialize(),
                    success: function(response)
                    {
                        var jsonData = JSON.parse(response);
                        console.log(jsonData);
                        if (jsonData.success !== 0)
                        {
                            localStorage.setItem("event_id", jsonData.success);
                            location.href = 'more_details.html';
                        }
                        else
                        {
                            alert('Invalid event!');
                        }
                    }
                });
            });
        });
    }
});