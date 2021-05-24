$.ajax({
    url: "view_events.php",
    type: 'GET',
    dataType: 'json',
    success: function(res) {
        console.log(res);
        let events = document.getElementById("events");
        events.innerHTML +=  "<h3>" + "                Event name                  Event Cluster          Machine group" +
            "         " + "Date                Time           Action" + "</h3>";
        for (var i= 0; i < 10; i++) {
            events.innerHTML += "<p>" + "<button>Edit</button>   " + "<button>Delete</button>   " + res[i].event_name +
                "               " + res[i].cluster_name + "               "
                + res[i].machine_group+ "               " +  res[i].date + "               " + res[i].time
                + "               " + res[i].activate + "</p>";
        }
    }
});