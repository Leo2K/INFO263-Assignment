$.ajax({
    url: "view_events.php",
    type: 'GET',
    dataType: 'json',
    success: function(res) {
        let event_id = localStorage.getItem("event_id");
        let event = res[event_id];
        console.log(event);
    }
});
