<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> AI-Powered Anemia Detection</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🔬</text></svg>">
</head>

<body>
    <div class="container">
        <header>
            <h1>Anemia Detector</h1>
            <p class="subtitle">AI-Powered Anemia Detection from Nail Images</p>
        </header>

        <div class="main-content">
            <div class="upload-section">

                <!-- User Info Section -->
                <div class="user-info">
                    <h2>🧑 User Information</h2>
                    <label for="userName">Name:</label>
                    <input type="text" id="userName" placeholder="Enter your name">

                    <label for="userGender">Gender:</label>
                    <select id="userGender">
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>

                    <label for="userAge">Age:</label>
                    <input type="number" id="userAge" placeholder="Enter your age" min="1">
                </div>

                <h2>📸 Upload Nail Image only</h2>
                <div class="upload-zone" id="uploadZone">
                    <div class="upload-icon">📁</div>
                    <div class="upload-text">
                        <strong>Click to upload</strong> or drag and drop your nail image here
                    </div>
                    <p style="color: #999; font-size: 0.9rem;">Supported formats: JPG, PNG, GIF (Max 5MB)</p>
                </div>
                <input type="file" id="fileInput" class="file-input" accept="image/*">
                <button class="btn" id="uploadBtn">Choose Image</button>

                <div id="imagePreview" style="display: none;">
                    <img id="previewImg" class="image-preview" alt="Uploaded nail image">
                    <button class="btn" id="analyzeBtn" disabled>🔍 Analyze Image</button>
                </div>
            </div>

            <div class="results-section">
                <h2>📊 Analysis Results</h2>

                <div class="loading" id="loadingIndicator">
                    <div class="spinner"></div>
                    <p>Analyzing your nail image...</p>
                    <p style="font-size: 0.9rem; color: #666;">This may take a few seconds</p>
                </div>

                <div id="resultsContainer" style="display: none;">
                    
                    <!-- User Details Card -->
                    <div class="result-card" id="userDetailsCard" style="display:none;">
                        <h3>👤 User Details</h3>
                        <p><strong>Name:</strong> <span id="displayName"></span></p>
                        <p><strong>Gender:</strong> <span id="displayGender"></span></p>
                        <p><strong>Age:</strong> <span id="displayAge"></span></p>
                    </div>

                    <div class="result-card">
                        <div class="prediction" id="predictionResult">Waiting for analysis...</div>
                        <div class="confidence" id="confidenceLevel">Confidence: --</div>

                        <div class="probability-bars">
                            <div class="probability-bar">
                                <span class="bar-label">Normal:</span>
                                <div class="bar">
                                    <div class="bar-fill normal" id="normalBar" style="width: 0%"></div>
                                </div>
                                <span class="percentage" id="normalPercentage">0%</span>
                            </div>
                            <div class="probability-bar">
                                <span class="bar-label">Anemic:</span>
                                <div class="bar">
                                    <div class="bar-fill anemic" id="anemicBar" style="width: 0%"></div>
                                </div>
                                <span class="percentage" id="anemicPercentage">0%</span>
                            </div>
                        </div>
                    </div>

                    <div class="result-card">
                        <h3>📈 Extracted Features</h3>
                        <div class="features-grid" id="featuresGrid">
                            <!-- Features will be populated here -->
                        </div>
                    </div>
                </div>

                <div id="noResults" style="text-align: center; color: #999; padding: 40px;">
                    <div style="font-size: 3rem; margin-bottom: 15px;">🩺</div>
                    <p>Upload a nail image to see analysis results</p>
                </div>
                <div>
                    <p> Anemia is a medical condition that occurs when the body lacks enough healthy red blood cells or hemoglobin to transport oxygen efficiently throughout the body. Without sufficient oxygen supply, organs and tissues cannot function properly, which leads to symptoms such as persistent fatigue, weakness, pale or yellowish skin, shortness of breath, dizziness, headaches, chest pain, or cold hands and feet. The most common causes include iron deficiency, vitamin B12 or folate deficiency, chronic illnesses such as kidney disease, significant blood loss, bone marrow problems, or inherited disorders like sickle cell anemia and thalassemia. Anemia can range from mild to severe and may develop gradually or suddenly. Diagnosis is usually done through blood tests, primarily a complete blood count (CBC). Treatment depends on the underlying cause and may include dietary improvements, supplements, medications, blood transfusions, or advanced medical procedures when necessary.
</p>
                </div>
            </div>
        </div>

        <div class="disclaimer">
           <div class="info-section">
    <h2>Tips for Better Results ✨</h2>
    <div class="info-grid">
        <div class="info-card">
            <div class="info-icon">☀️</div>
            <h3>Natural Light</h3>
            <p>Take the nail photo in natural daylight for clear and accurate results.</p>
        </div>
        <div class="info-card">
            <div class="info-icon">📸</div>
            <h3>Focus</h3>
            <p>Keep the camera steady and ensure the nail is in focus.</p>
        </div>
        <div class="info-card">
            <div class="info-icon">🧼</div>
            <h3>Clean Nails</h3>
            <p>Ensure nails are clean and free from polish or dirt.</p>
        </div>
    </div>
</div>
        </div>

        <div class="info-section">
           

            <h2 style="text-align: center; margin-bottom: 30px; color: #667eea;">How It Works</h2>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon">🖼</div>
                    <h3>Image Analysis</h3>
                    <p>Our AI analyzes color patterns, saturation, and other visual characteristics of your nail beds
                        that may indicate anemia.</p>
                </div>
                <div class="info-card">
                    <div class="info-icon">🤖</div>
                    <h3>Machine Learning</h3>
                    <p>Advanced algorithms trained on medical data detect subtle changes in nail color that correlate
                        with hemoglobin levels.</p>
                </div>
                <div class="info-card">
                    <div class="info-icon">📋</div>
                    <h3>Instant Results</h3>
                    <p>Get immediate feedback with confidence scores and detailed feature analysis to understand the
                        assessment.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
+++++