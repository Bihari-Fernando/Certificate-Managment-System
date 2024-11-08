<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IEEE Certificate Request Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-image: url(''); /* Replace 'IEEE.jpeg' with the path to your background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-color: #abcbf1;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }

        .chapter-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgba(241, 245, 252, 0.5); /* Adding transparency */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            padding: 20px;
            text-align: center;
            height: 400px;
            justify-content: space-between;
        }

        .chapter-title {
            font-size: 18px;
            font-weight: bold;
            color: #2e3a59;
            margin-bottom: 20px;
        }

        .chapter-image-container {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chapter-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .button-container {
            margin-top: auto;
        }

        button {
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            background-color: #0c51a2;
            color: white;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #8fc0fa;
        }
    </style>
</head>

<body>
    <h1>IEEE Certificate Request</h1>
    <div class="container">
        <div class="chapter-box">
            <div class="chapter-title">CIS Chapter</div>
            <div class="chapter-image-container">
                <img src="IEEE_CIS.png" alt="CIS Chapter" class="chapter-image"> <!-- Add your image here -->
            </div>
            <div class="button-container">
                <a href="chapters/CIS.php"><button>Request</button></a>
            </div>
        </div>
        
        <div class="chapter-box">
            <div class="chapter-title">CS Chapter</div>
            <div class="chapter-image-container">
                <img src="CS.png" alt="CS Chapter" class="chapter-image"> <!-- Add your image here -->
            </div>
            <div class="button-container">
                <a href="chapters/CS.php"><button>Request</button></a>
            </div>
        </div>
        
        <div class="chapter-box">
            <div class="chapter-title">WIE Chapter</div>
            <div class="chapter-image-container">
                <img src="IEEE_WIE.png" alt="WIE Chapter" class="chapter-image"> <!-- Add your image here -->
            </div>
            <div class="button-container">
                <a href="chapters/WIE.php"><button>Request</button></a>
            </div>
        </div>
    </div>
</body>

</html>
