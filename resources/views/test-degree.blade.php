<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Degree</title>
</head>
<body>
    <h1>Degree Test Result</h1>

    <p><strong>Degree:</strong> {{ $degree }}</p>
    <p><strong>Execution Time:</strong> {{ number_format($executionTime, 4) }} seconds</p>
    <p><strong>Number of Queries:</strong> {{ $queriesCount }}</p>

</body>
</html>
