<?php
include 'connection.php'; 

$api_key = 'AIzaSyAGTkF8vWxZlb8d7wK4ZvDS-tDy75oQBdk'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['syllabus']) && $_FILES['syllabus']['error'] == 0) {
    $difficulty = $_POST['difficulty']; 
    $file_path = $_FILES['syllabus']['tmp_name'];
    $file_size = $_FILES['syllabus']['size'];

    // Validate file type
    $file_type = mime_content_type($file_path);
    $allowed_types = ['image/png', 'image/jpeg', 'application/pdf'];
    if (!in_array($file_type, $allowed_types)) {
        die("Error: Unsupported file format. Use PNG, JPEG, or PDF.");
    }

    // Convert file to base64
    $file_data = base64_encode(file_get_contents($file_path));

    // AI Request
    $api_url = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=$api_key";
    $data = json_encode([
        "contents" => [
            [
                "parts" => [
                    ["text" => "Extract syllabus details and generate:
                        - 10 three-mark questions (together)
                        - Two seven-mark questions per module (Modules 1 to 5)
                        - Difficulty: '$difficulty'"],
                    ["inlineData" => [
                        "mimeType" => $file_type,
                        "data" => $file_data
                    ]]
                ]
            ]
        ]
    ]);

    // cURL Request
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo "cURL Error: " . curl_error($ch);
        exit;
    }
    curl_close($ch);

    $response_data = json_decode($response, true);
    $questions = $response_data['candidates'][0]['content']['parts'][0]['text'] ?? "Error processing the request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Syllabus</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        /* General Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            background: url('ai2.jpg') no-repeat center center fixed;
            background-size: cover;
            background-blend-mode: overlay;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #ff;
        }

        .container {
            background: #fff;
            color:#000;
            padding: 40px;
            border-radius: 15px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
            text-align: center;
            animation: fadeIn 1.2s ease-in-out;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            text-align: left;
        }

        input[type="file"], select, textarea {
            background: rgba(255, 255, 255, 0.3);
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            color: #000;
            width: 100%;
            transition: all 0.3s ease;
        }

        input[type="file"]:hover, select:hover, textarea:hover {
            border-color:rgb(3, 2, 19);
        }

        button {
            background:rgb(82, 76, 76);
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        button:hover {
            background:rgb(68, 53, 54);
            transform: scale(1.05);
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 8px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        function copyToClipboard() {
            let text = document.getElementById("editable-questions").value;
            navigator.clipboard.writeText(text).then(() => alert("Copied to clipboard!"));
        }

        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            let doc = new jsPDF();

            doc.setFont("helvetica", "bold");
            doc.text("Generated Question Paper", 10, 10);
            doc.setFont("helvetica", "normal");

            let questions = document.getElementById("editable-questions").value;
            let margin = 10;
            let y = 20;
            let pageHeight = doc.internal.pageSize.height;

            let lines = doc.splitTextToSize(questions, 180);
            lines.forEach((line) => {
                if (y + 10 > pageHeight) {
                    doc.addPage();
                    y = 10;
                }
                doc.text(line, margin, y);
                y += 8;
            });

            doc.save("Question_Paper.pdf");
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Upload Files for AI Question Generation</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="syllabus" required>
            <select name="difficulty" required>
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
            </select>
            <button type="submit">Generate Questions</button>
        </form>

        <?php if (isset($questions)): ?>
            <h3>Generated Questions:</h3>
            <textarea id="editable-questions"><?php echo htmlspecialchars($questions); ?></textarea>
            <button onclick="copyToClipboard()">Copy</button>
            <button onclick="downloadPDF()">Download as PDF</button>
        <?php endif; ?>
    </div>
</body>
</html>
