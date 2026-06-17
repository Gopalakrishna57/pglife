<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to PG-Life</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="css/common.css">

    <style>
        /* Banner */
        .dynamic-banner {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            animation: sliderChange 18s infinite ease-in-out;
        }

        @keyframes sliderChange {
            0%,100% {
                background-image: url('https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1920');
            }
            20% {
                background-image: url('https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?q=80&w=1920');
            }
            40% {
                background-image: url('https://images.unsplash.com/photo-1505691938895-1758d7feb511?q=80&w=1920');
            }
            60% {
                background-image: url('https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=1920');
            }
            80% {
                background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=1920');
            }
        }

        /* Cities Section */
        .city-section {
            background: linear-gradient(135deg, #e5eaf6, #cccfd6);
            padding: 60px 0;
        }

        .city-section h2 {
            color: #131313;
            font-weight: bold;
        }

        .city-card {
            border: none;
            border-radius: 50px;
            text-align: center;
            padding: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            height: 100%;
            background: #ffffff; /* Added white background for standard look */
        }

        .city-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(115, 112, 112, 0.25);
        }

        .city-card img {
            width: 150px;
            height: 150px;
            border-radius: 75px;
            object-fit: cover;
            border: 4px solid #fffcfc;
            margin-top: 10px;
        }

        .city-card .city-name {
            margin-top: 15px;
            font-weight: 600;
            color: #131313; /* Adjusted text color for readability against white card */
        }
    </style>
</head>

<body>
<?php include "header.php"; ?>

<div class="dynamic-banner">
    <div class="search-container text-center">
        <h2 class="white pb-3" style="color: white; text-shadow: 1px 1px 10px rgba(0,0,0,0.5);">Happiness Is Finding A Best PG</h2>

        <form id="search-form" action="property_list.php" method="GET">
            <div class="input-group city-search">
                <input type="text"
                       class="form-control input-city"
                       id="city"
                       name="city"
                       placeholder="Enter your city to search for PGs">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="city-section">
    <div class="container">
        <h2 class="text-center mb-5">Popular Cities</h2>

        <div class="row">

            <div class="col-md-3 mb-4">
                <a href="property_list.php?city=Hyderabad" class="text-decoration-none">
                    <div class="city-card">
                        <img src="https://images.unsplash.com/photo-1657981630164-769503f3a9a8?q=80&w=435&auto=format&fit=crop" alt="Hyderabad">
                        <div class="city-name">Hyderabad</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="property_list.php?city=Bengaluru" class="text-decoration-none">
                    <div class="city-card">
                        <img src="https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=800" alt="Bangalore">
                        <div class="city-name">Bangalore</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="property_list.php?city=Mumbai" class="text-decoration-none">
                    <div class="city-card">
                        <img src="https://images.unsplash.com/photo-1566552881560-0be862a7c445?w=800" alt="Mumbai">
                        <div class="city-name">Mumbai</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="property_list.php?city=Delhi" class="text-decoration-none">
                    <div class="city-card">
                        <img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?w=800" alt="Delhi">
                        <div class="city-name">Delhi</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="property_list.php?city=Chennai" class="text-decoration-none">
                    <div class="city-card">
                        <img src="https://media.istockphoto.com/id/1211952929/photo/marina-beach-chennai-city-tamil-nadu-india-bay-of-bengal-chennai-tourism-east-coast-road.jpg?s=1024x1024&w=is&k=20&c=XL4-z9Cm8uyt5A9SYQ8BFZdpltTX9HwNTZLiDg_KR-M=" alt="Chennai">
                        <div class="city-name">Chennai</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="property_list.php?city=Kolkata" class="text-decoration-none">
                    <div class="city-card">
                        <img src="https://media.istockphoto.com/id/1164386039/photo/howrah-bridge-on-river-ganges-at-kolkata-at-twilight-with-moody-sky.jpg?s=1024x1024&w=is&k=20&c=10tsj8ySvJFuqDgHS93bN8NnSLpBjjaH3LByu8jUr3E=" alt="Kolkata">
                        <div class="city-name">Kolkata</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="property_list.php?city=Visakhapatnam" class="text-decoration-none">
                    <div class="city-card">
                        <img src="https://media.istockphoto.com/id/1068859654/photo/ramakrishna-beach.jpg?s=1024x1024&w=is&k=20&c=RMyTjNk6mSJLnsS0-wa5-WkGG6r9pthQ9NJL9zu3O7E=" alt="Visakhapatnam">
                        <div class="city-name">Visakhapatnam</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="property_list.php?city=Vijayawada" class="text-decoration-none">
                    <div class="city-card">
                        <img src="https://i0.wp.com/stanzaliving.wpcomstaging.com/wp-content/uploads/2022/04/45251-places-to-visit-in-vijayawada.jpg?fit=1000%2C562&ssl=1" alt="Vijayawada">
                        <div class="city-name">Vijayawada</div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>

</body>
</html>