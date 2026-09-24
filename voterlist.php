<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "student";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all voters
$sql = "SELECT usn, name, branch, gender, semester, mobile FROM voter ORDER BY name";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Voters</title>
    <link rel="website icon" type="png" href="https://thumbs.dreamstime.com/b/check-mark-vote-logo-vector-logo-check-mark-vote-symbol-188941428.jpg">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .search-container {
            display: flex;
            margin-bottom: 20px;
            gap: 10px;
        }
        .search-input {
            flex: 1;
            padding: 10px 15px;
            border: 2px solid #3498db;
            border-radius: 4px;
            font-size: 16px;
            transition: all 0.3s;
        }
        .search-input:focus {
            outline: none;
            border-color: #2980b9;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }
        .search-button {
            padding: 10px 20px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
        }
        .search-button:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        .back-btn {
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #2ecc71;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
        }
        .back-btn:hover {
            background: #27ae60;
            transform: translateY(-2px);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #3498db;
            color: white;
            font-weight: 500;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e6f7ff;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-btn" onclick="window.history.back()">
            ← Back
        </button>

        <h1>Registered Voters</h1>
        
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search by USN, Name or Branch..." id="searchInput">
            <button class="search-button" onclick="searchTable()">
                <i class="fas fa-search"></i> Search
            </button>
        </div>
        
        <?php if ($result->num_rows > 0): ?>
            <table id="votersTable">
                <thead>
                    <tr>
                        <th>USN</th>
                        <th>Name</th>
                        <th>Branch</th>
                        <th>Gender</th>
                        <th>Semester</th>
                        <th>Mobile</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['usn']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['branch']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['semester']); ?></td>
                        <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">No voters registered yet.</p>
        <?php endif; ?>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toUpperCase();
            const table = document.getElementById("votersTable");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                const tds = tr[i].getElementsByTagName("td");
                let found = false;
                
                for (let j = 0; j < tds.length; j++) {
                    const td = tds[j];
                    if (td) {
                        const txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                
                tr[i].style.display = found ? "" : "none";
            }
        }

        // Add event listener for Enter key
        document.getElementById("searchInput").addEventListener("keyup", function(event) {
            if (event.key === "Enter") {
                searchTable();
            }
        });
    </script>

    <?php $conn->close(); ?>
</body>
</html>