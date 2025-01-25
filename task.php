<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $contactNo = $_POST['contactNo'];
    $tenderNo = $_POST['tenderNo'];
    $projectName = $_POST['projectName'];
    $assignedTeam = $_POST['assignedTeam'];
    $currentStatus = $_POST['currentStatus'];
    $projectDuration = $_POST['projectDuration'];
    $clientName = $_POST['clientName'];
    $clientId = $_POST['clientId'];
    $pileType = $_POST['pileType'];
    $noOfPiles = $_POST['noOfPiles'];
    $pileLength = $_POST['pileLength'];
    $pileRate = $_POST['pileRate'];
    $penetrationRecord = $_POST['penetrationRecord'];
    $rigDetails = $_POST['rigDetails'];
    $address = $_POST['address'];
    $rigLength = $_POST['rigLength'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $restrike = $_POST['restrike'];
    $pilingDays = $_POST['pilingDays'];

    // Process the uploaded image if there is one
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imagePath = 'uploads/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $imagePath = NULL;
    }

    // SQL query to update project details
    $sql = "UPDATE project_details 
            SET contact_no='$contactNo', tender_no='$tenderNo', project_name='$projectName', 
                assigned_team='$assignedTeam', current_status='$currentStatus', project_duration='$projectDuration',
                client_name='$clientName', client_id='$clientId', pile_type='$pileType', 
                no_of_piles='$noOfPiles', pile_length='$pileLength', pile_rate='$pileRate', 
                penetration_record='$penetrationRecord', rig_details='$rigDetails', 
                address='$address', rig_length='$rigLength', start_date='$startDate', end_date='$endDate', 
                restrike='$restrike', piling_days='$pilingDays', image_path='$imagePath'
            WHERE id = 1"; // Assuming we are updating project with id = 1

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>task</title>
  <style>
        * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      overflow-x: hidden;
    }

    .header {
      width: 70%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: white;
      color: white;
      position: relative;
      padding: 10px 20px;
      margin-left: 350px;
      top: 20px;
    }

    .header .search-bar {
      display: flex;
      align-items: center;
      background-color: white;
      padding: 5px 10px;
      border-radius: 20px;
      width: 300px;
    }

    .header .search-bar input {
      border: none;
      outline: none;
      margin-left: 10px;
      flex: 1;
      font-size: 1em;
    }

    .header .icons {
      display: flex;
      align-items: center;
    }

    .header .icons .icon {
      margin: 0 10px;



      font-size: 1.2em;
      cursor: pointer;
    }

    .header .admin {
      display: flex;
      align-items: center;
      cursor: pointer;
    }

    .header .admin img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .header .admin span {
      margin-left: 5px;
      color:black;
    }

    .sidebar {
      width: 250px;
      background-color: #1d3557;
      color: #fff;
      display: flex;
      flex-direction: column;
      height: 100vh;
      position: fixed;
      left: 20px;
      top: 20px;
      border-radius: 40px;
      transition: transform 0.3s ease-in-out;
    }

    .sidebar.hidden {
      transform: translateX(-250px);
    }

    .sidebar h1 {
      text-align: center;
      padding: 20px;
      background-color: #1d3557;
      margin: 0;
      font-size: 1.5em;
      border-radius: 40px;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .sidebar ul li {
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .sidebar ul li a {
      text-decoration: none;
      color: #fff;
      font-size: 1em;
      display: flex;
      align-items: center;
    }

    .sidebar ul li a .icon {
      margin-right: 10px;
    }

    .sidebar ul li a .plus-icon {
      margin-left: 20px;
    }

    .sidebar ul li a:hover {
      background-color: white;
      border-radius: 5px;
      color: red;
      width: 200px;
      height: 40px;
      border-top-left-radius: 20px;
      border-end-start-radius: 20px;
    }

    .content {
      margin-left: 280px;
      padding: 20px;
      width: 100%;
      transition: margin-left 0.3s ease-in-out;
    }

    .content.shifted {
      margin-left: 0;
    }
    .form-container {
      margin-top: 20px;
    width: 90%;
      padding: 40px;
    }

    .form-label {
      display: flex;
      align-items: center;
      font-size: 1.2rem;
      font-weight: bold;
      color: #1d3557;
    }

    .form-label svg {
      margin-right: 10px;
    }

    .toggle-btn {
      position: fixed;
      top: 25px;
      left: 275px;
      background-color: white;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
      z-index: 1000;
      border-radius: 5px;
      font-size: 1em;
    }
    .table-container {
      margin-top: 0px;
    width: 90%;
    
      padding: 40px;
      margin-left: 200px;
     }
    .table-container h3{
      
      display: flex;
      align-items: center;
      font-size: 1.2rem;
      font-weight: bold;
      color: #1d3557;
    }
    .btn-upload {
      width: 100%;
    }
    .form-control {
      width: 100%;
    }
    .table thead th {
      background-color:#1d3557; /* Blue color */
      color: white;
    }
    .table {
      border-collapse: collapse;
    }
    .table td, .table th {
      border: none; /* Removes table borders */
    }
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-250px);
      }

      .content {
        margin-left: 0;
      }

      .header .search-bar {
        width: 200px;
      }
    }

  </style>
</head>
<body>



<div class="header">
    <div class="search-bar">
      <span><svg xmlns="http://www.w3.org/2000/svg" color="black" width="16" height="16" fill="currentColor" class="bi bi-search-heart" viewBox="0 0 16 16">
        <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
        <path d="M13 6.5a6.47 6.47 0 0 1-1.258 3.844q.06.044.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11"/>
      </svg></span>
      <input type="text" placeholder="Search here">
    </div>
    <div class="icons">
      <span class="icon">⬜</span>
      <span class="icon">✉️</span>
      <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" color="black" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
      </svg></span>
      <div class="admin">
        <img src="data:image/jpeg;base64,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" alt="Admin">
        <span>Admin</span>
        <span>▼</span>
      </div>
    </div>
  </div>

  <button class="toggle-btn" id="toggle-btn">☰</button>
  <div class="sidebar" id="sidebar">
    <h1>LOGO</h1>
    <ul>
      <li><a href="#dashboard"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
      </svg></span>Dashboard<span class="plus-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
      </svg></span></a></li>
      <li><a href="#master-data"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
        <path d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313M13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A5 5 0 0 0 13 5.698M14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A5 5 0 0 0 13 8.698m0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525"/>
      </svg></span>Master Data<span class="plus-icon">+</span></a></li>
      <li><a href="#hrm"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
      </svg></span>HRM<span class="plus-icon">+</span></a></li>
      <li><a href="#project-management"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-kanban" viewBox="0 0 16 16">
        <path d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
        <path d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1z"/>
      </svg></span>Project Management<span class="plus-icon">+</span></a></li>
      <li><a href="#vehicle-check"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
        <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276"/>
        <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z"/>
      </svg></span>Vehicle Check<span class="plus-icon">+</span></a></li>
      <li><a href="#archive"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
        <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
      </svg></span>Archive<span class="plus-icon">+</span></a></li>
      <li><a href="#misreport"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
      </svg></span>MIS Report<span class="plus-icon">+</span></a></li>
    </ul>
  </div>

<div class="content">
    <!-- Form Section -->
    <div class="form-container">
        <label class="form-label">
            Edit Project Management Details
        </label>
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <!-- Row 1 -->
        <div class="col-md-5">
          <label for="contactNo" class="form-label">Contact No</label>
          <input type="text" class="form-control" id="contactNo" placeholder="Enter contact number">
        </div>
        <div class="col-md-5">
          <label for="tenderNo" class="form-label">Tender No</label>
          <input type="text" class="form-control" id="tenderNo" placeholder="Enter tender number">
        </div>
        <!-- Row 2 -->
        <div class="col-md-5">
          <label for="projectName" class="form-label">Project Name</label>
          <input type="text" class="form-control" id="projectName" placeholder="Enter project name">
        </div>
        <div class="col-md-5">
          <label for="assignedTeam" class="form-label">Assigned Team</label>
          <select class="form-select" id="assignedTeam">
            <option selected disabled>Choose team</option>
            <option value="1">Team A</option>
            <option value="2">Team B</option>
            <option value="3">Team C</option>
          </select>
        </div>
        <!-- Row 3 -->
        <div class="col-md-5">
          <label for="currentStatus" class="form-label">Current Status</label>
          <input type="text" class="form-control" id="currentStatus" placeholder="Enter current status">
        </div>
        <div class="col-md-5">
          <label for="projectDuration" class="form-label">Project Duration</label>
          <input type="text" class="form-control" id="projectDuration" placeholder="Enter project duration">
        </div>
        <!-- Row 4 -->
        <div class="col-md-5">
          <label for="clientName" class="form-label">Client Name</label>
          <input type="text" class="form-control" id="clientName" placeholder="Enter client name">
        </div>
        <div class="col-md-5">
          <label for="clientId" class="form-label">Client ID</label>
          <input type="text" class="form-control" id="clientId" placeholder="Enter client ID">
        </div>
        <!-- Row 5 -->
        <div class="col-md-5">
          <label for="pileType" class="form-label">Pile Type</label>
          <input type="text" class="form-control" id="pileType" placeholder="Enter pile type">
        </div>
        <div class="col-md-5">
          <label for="noOfPiles" class="form-label">No. of Piles</label>
          <input type="text" class="form-control" id="noOfPiles" placeholder="Enter number of piles">
        </div>
        <!-- Row 6 -->
        <div class="col-md-5">
          <label for="pileLength" class="form-label">Pile Designed Length</label>
          <input type="text" class="form-control" id="pileLength" placeholder="Enter pile designed length">
        </div>
        <div class="col-md-5">
          <label for="pileRate" class="form-label">Expected Pile Installation Rate</label>
          <input type="text" class="form-control" id="pileRate" placeholder="Enter expected rate">
        </div>
        <!-- Row 7 -->
        <div class="col-md-5">
          <label for="penetrationRecord" class="form-label">Penetration Record</label>
          <input type="text" class="form-control" id="penetrationRecord" placeholder="Enter penetration record">
        </div>
        <div class="col-md-5">
          <label for="rigDetails" class="form-label">Rig Details</label>
          <input type="text" class="form-control" id="rigDetails" placeholder="Enter rig details">
        </div>
        <!-- Row 8 -->
        <div class="col-md-5">
          <label for="address" class="form-label">Address</label>
          <input type="text" class="form-control" id="address" placeholder="Enter address">
        </div>
        <div class="col-md-5">
          <label for="rigLength" class="form-label">Rig Length</label>
          <input type="text" class="form-control" id="rigLength" placeholder="Enter rig length">
        </div>
        <!-- Row 9 -->
        <div class="col-md-5">
          <label for="startDate" class="form-label">Start Date</label>
          <input type="date" class="form-control" id="startDate">
        </div>
        <div class="col-md-5">
          <label for="endDate" class="form-label">End Date</label>
          <input type="date" class="form-control" id="endDate">
        </div>
        <!-- Row 10 -->
        <div class="col-md-5">
          <label for="restrike" class="form-label">Restrike</label>
          <input type="text" class="form-control" id="restrike" placeholder="Enter restrike">
        </div>
        <div class="col-md-5">
          <label for="pilingDays" class="form-label">No. of Days Piling</label>
          <input type="text" class="form-control" id="pilingDays" placeholder="Enter number of days piling">
        </div>
        </form>
    </div>
</div>
<div class="container">
    <div class="table-container">
      <h3 class="mb-4">Project Details Table</h3>
      <table id="dynamicTable" class="table table-bordered mt-3">
        <thead class="table-dark">
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Diagram</th>
            <th scope="col">Planned By</th>
            <th scope="col">Planned Date</th>
            <th scope="col">Diagram No</th>
            <th scope="col">Revision No</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <input type="file" class="form-control form-control-sm" accept="image/*">
            </td>
            <td>
              <button class="btn btn-danger btn-sm btn-upload">Upload Diagram</button>
            </td>
            <td>
              <input type="text" class="form-control form-control-sm" placeholder="Enter name">
            </td>
            <td>
              <input type="date" class="form-control form-control-sm">
            </td>
            <td>
              <input type="text" class="form-control form-control-sm" placeholder="Enter diagram no">
            </td>
            <td>
              <input type="text" class="form-control form-control-sm" placeholder="Enter revision no">
            </td>
          </tr>
          <!-- Additional Rows Can Be Added Here -->
        </tbody>
      </table>
      <button class="btn btn-primary mt-3" id="addRowBtn">Add More</button>
    </div>

  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-auto">
            <!-- Reset button (danger) -->
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
        <div class="col-auto">
            <!-- Submit button (primary) -->
            <button type="submit" id="projectForm" class="btn btn-primary">update</button>
        </div>
    </div>
</div>

</body>
</html>

<script>
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('hidden');
      content.classList.toggle('shifted');
    });
    document.addEventListener('DOMContentLoaded', function () {
    // Attach event listener to the "Add Row" button
    const addRowBtn = document.getElementById('addRowBtn');

    if (addRowBtn) {
        addRowBtn.addEventListener('click', function () {
            // Get the table body
            const tableBody = document.querySelector('#dynamicTable tbody');

            if (tableBody) {
                // Create a new row
                const newRow = document.createElement('tr');

                // Define the new row content
                newRow.innerHTML = `
                  <td>
                    <input type="file" class="form-control form-control-sm" accept="image/*">
                  </td>
                  <td>
                    <button class="btn btn-danger btn-sm btn-upload">Upload Diagram</button>
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm" placeholder="Enter name">
                  </td>
                  <td>
                    <input type="date" class="form-control form-control-sm">
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm" placeholder="Enter diagram no">
                  </td>
                  <td>
                    <input type="text" class="form-control form-control-sm" placeholder="Enter revision no">
                  </td>
                `;

                // Append the new row to the table body
                tableBody.appendChild(newRow);
            } else {
                console.error('Table body not found! Make sure the table has a <tbody> element.');
            }
        });
    } else {
        console.error('Add Row button not found! Ensure the button ID is "addRowBtn".');
    }
});
document.getElementById("projectForm").addEventListener("submit", function(event) {
      let formIsValid = true;
      const form = event.target;
      const inputs = form.querySelectorAll("input, select");

      // Loop through each input and check if it's empty
      inputs.forEach(function(input) {
        if (input.value.trim() === "") {
          formIsValid = false;
          input.classList.add("is-invalid");  // Add Bootstrap invalid class
        } else {
          input.classList.remove("is-invalid");  // Remove invalid class if filled
        }
      });

      // If any field is empty, prevent form submission and show an alert
      if (!formIsValid) {
        event.preventDefault();
        alert("Please fill out all required fields.");
      }
    });
  </script>

