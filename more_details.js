$.ajax({
    url: "view_events.php",
    type: 'GET',
    dataType: 'json',
    success: function(res) {
        let event_id = localStorage.getItem("event_id");
        let event = res[event_id];
        console.log(event[0]);
        for (i = 0; i < event.length; i++) {
            var tableRef = document.getElementById("TableA");

            // Insert a row in the table at row index 0
            var newRow = tableRef.insertRow(0);


            // Insert a cells in the rows
            var name = newRow.insertCell(0);
            name.innerHTML = event[i].event_name;
            var eventId = newRow.insertCell(1);
            eventId.innerHTML = event[i].event_id;
            var cluster = newRow.insertCell(2);
            cluster.innerHTML = event[i].cluster_name;
            var group = newRow.insertCell(3);
            group.innerHTML = event[i].machine_group;
            var date = newRow.insertCell(4);
            date.innerHTML = event[i].date;
            var time  = newRow.insertCell(5);
            time.innerHTML = event[i].time;
        }

    }
});
