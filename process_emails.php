<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputText = $_POST['inputText'];
    $separator = $_POST['separator'];
    $sort = isset($_POST['sort']);

    // Regular Expression to extract email addresses
    preg_match_all('/[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/', $inputText, $matches);

    // Get unique emails and sort if needed
    $emails = array_unique($matches[0]);
    if ($sort) {
        sort($emails);
    }

    // Join emails with the selected separator
    $output = implode($separator === "\\n" ? "\n" : $separator, $emails);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Extractor Lite - Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            text-align: center;
            border: 1px solid #000;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
        }
        textarea {
            width: 100%;
            height: 150px;
            margin-bottom: 10px;
            padding: 10px;
        }
        .output {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Email Extractor Lite - Results</h1>
        <div class="output">
            <h3>Extracted Emails:</h3>
            <textarea readonly><?php echo htmlspecialchars($output ?? "No emails found."); ?></textarea>
        </div>
        <button onclick="window.history.back()">Back</button>
    </div>
</body>
</html>
