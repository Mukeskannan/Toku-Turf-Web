window.onload = function() {
    var username = localStorage.getItem("tname");
    var useremail = localStorage.getItem("temail");

    if (username && useremail) {
        console.log("Username:", username);
        console.log("User Email:", useremail);

       
    } else {
        console.log("No data found in localStorage.");
    }
};

window.onload = function() {
    var username = localStorage.getItem("tname"); // Get username from localStorage

    if (username) {
        console.log("Username:", username);

        // Send username to the server to fetch booking history
        fetch("fetch_booking.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `tname=${encodeURIComponent(username)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.log("No booking found.");
            } else {
                let historyContainer = document.getElementById("history-container");

                data.forEach(booking => {
                    let bookingDiv = document.createElement("div");
                    bookingDiv.id = "d1";
                    bookingDiv.innerHTML = `
                        <div id="customer_name"><strong>Customer Name:</strong> ${booking.customer_name}</div>
                        <div id="customer_location"><strong>Customer Location:</strong> ${booking.customer_location}</div>
                        <div id="customer_email"><strong>Customer Email:</strong> ${booking.customer_email}</div>
                        <div id="customer_date"><strong>Booking Date:</strong> ${booking.customer_date}</div>
                        <div id="customer_start_time"><strong>Start Time:</strong> ${booking.customer_start_time}</div>
                        <div id="customer_end_time"><strong>End Time:</strong> ${booking.customer_end_time}</div>
                        <div id="turf_name"><strong>Turf Name:</strong> ${booking.turf_name}</div>
                        <div id="turf_location"><strong>Turf Location:</strong> ${booking.turf_location}</div>
                        <div id="turf_contact"><strong>Turf Contact:</strong> ${booking.turf_contact}</div>
                        <div id="turf_totaltime"><strong>Total Time:</strong> ${booking.turf_totaltime}</div>
                        <div id="turf_ttid"><strong>Turf ID:</strong> ${booking.turf_ttid}</div>
                        <div id="digitalpin"><strong>Digital Pin:</strong> ${booking.digitalpin}</div>
                        <hr>
                    `;
                    historyContainer.appendChild(bookingDiv);
                });
            }
        })
        .catch(error => console.error("Error fetching data:", error));
    } else {
        console.log("No user data in localStorage.");
    }
};
