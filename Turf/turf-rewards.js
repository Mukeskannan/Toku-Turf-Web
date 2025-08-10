
  window.onload = function() {
    // Get the username from localStorage
    var customerUsername = localStorage.getItem("tname");

    // If the username exists in localStorage
    if (customerUsername) {
        // Fetch points from the back-end (PHP)
        fetch(`fetch_points.php?customerusername=${customerUsername}`)
            .then(response => response.json())
            .then(data => {
                if (data.points !== null) {
                    // If points are found, update the points div with the value
                    document.querySelector('.points').textContent = `Points: ${data.points}`;
                } else {
                    // If the username is not found, display a message
                    document.querySelector('.points').textContent = data.message || "No points found";
                }
            })
            .catch(error => {
                console.error("Error fetching points:", error);
                document.querySelector('.points').textContent = "Error fetching points.";
            });
    } else {
        document.querySelector('.points').textContent = "No username found in localStorage.";
    }
};