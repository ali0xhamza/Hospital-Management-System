<?php
session_start();

 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f9;
        }

        header {
            background: #007bff;
            color: white;
            padding: 1rem 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
        }

        .carousel {
            position: relative;
            max-width: 100%;
            height: 700px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        .slides {
            display: flex;
            transition: transform 1s ease-in-out;
            width: 100%;
        }

        .slide {
            min-width: 90%;
            height: 700%;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .carousel-buttons {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .carousel-buttons button {
            border: none;
            background: #fff;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            cursor: pointer;
        }

        .carousel-buttons button.active {
            background: #007bff;
        }

        .content-section {
            text-align: center;
            margin: 20px;
        }
        
      .button-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    max-width: 800px;
    margin: 50px auto;
}

.button-container button {
    flex: 0 0 calc(33.33% - 20px);
    height: 80px;
    width: 100%; 
    box-sizing: border-box;
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
    
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
        .button-container a {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 18px;
            transition: background 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .button-container a:hover {
            background: #0056b3;
        }
footer {
    text-align: center;
    padding: 10px;
    background: #007bff;
    color: white;
    margin-top: auto;
    box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
}

    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Hospital Management System</h1>
    </header>

    <div class="carousel">
        <div class="slides">
            <div class="slide">
                <img src="assets/images/image1.jpg" alt="Hospital Image 1">
            </div>
            <div class="slide">
                <img src="assets/images/image2.jpg" alt="Hospital Image 2">
            </div>
            <div class="slide">
                <img src="assets/images/image3.jpg" alt="Hospital Image 3">
            </div>
        </div>
        <div class="carousel-buttons">
            <button data-slide="0" class="active"></button>
            <button data-slide="1"></button>
            <button data-slide="2"></button>
        </div>
    </div>

    <div class="content-section">
        <h2>Efficiently Manage Your Hospital's Operations</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <p>Use the navigation below to access the various functionalities of the system.</p>
    </div>

 
    <div class="button-container">
        <a href="patient_management/add_patient.php">Add Patient</a>
        <a href="patient_management/view_patients.php">View Patients</a>
        <a href="doctor_management/add_doctor.php">Add Doctor</a>
        <a href="doctor_management/view_doctors.php">View Doctors</a>
        <a href="appointment_management/add_appointment.php">Add Appointment</a>
        <a href="appointment_management/view_appointments.php">View Appointments</a>
        <a href="billing/bills.php">Manage Bills</a>
        <a href="logout.php">Logout</a>
    </div>

    <footer>
        &copy; 2025 Hospital Management System
    </footer>

    <script>
        const slides = document.querySelector('.slides');
        const buttons = document.querySelectorAll('.carousel-buttons button');
        let currentSlide = 0;

        function changeSlide(index) {
            slides.style.transform = `translateX(-${index * 100}%)`;
            buttons.forEach(button => button.classList.remove('active'));
            buttons[index].classList.add('active');
            currentSlide = index;
        }

        buttons.forEach((button, index) => {
            button.addEventListener('click', () => changeSlide(index));
        });
 
        setInterval(() => {
            currentSlide = (currentSlide + 1) % buttons.length;
            changeSlide(currentSlide);
        }, 5000);
    </script>
</body>
</html>
