// DOM ELEMENTS
const uploadZone = document.getElementById("uploadZone");
const fileInput = document.getElementById("fileInput");
const uploadBtn = document.getElementById("uploadBtn");
const previewImg = document.getElementById("previewImg");
const imagePreview = document.getElementById("imagePreview");
const analyzeBtn = document.getElementById("analyzeBtn");

const loadingIndicator = document.getElementById("loadingIndicator");
const resultsContainer = document.getElementById("resultsContainer");
const noResults = document.getElementById("noResults");

const predictionResult = document.getElementById("predictionResult");
const confidenceLevel = document.getElementById("confidenceLevel");
const normalBar = document.getElementById("normalBar");
const anemicBar = document.getElementById("anemicBar");
const normalPercentage = document.getElementById("normalPercentage");
const anemicPercentage = document.getElementById("anemicPercentage");
const featuresGrid = document.getElementById("featuresGrid");

// User Details
const displayName = document.getElementById("displayName");
const displayGender = document.getElementById("displayGender");
const displayAge = document.getElementById("displayAge");
const userDetailsCard = document.getElementById("userDetailsCard");

// -------- FILE UPLOAD HANDLERS --------
uploadBtn.addEventListener("click", () => fileInput.click());

fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) handleFile(file);
});

uploadZone.addEventListener("click", () => fileInput.click());

uploadZone.addEventListener("dragover", (e) => {
    e.preventDefault();
    uploadZone.classList.add("drag-over");
});

uploadZone.addEventListener("dragleave", () => {
    uploadZone.classList.remove("drag-over");
});

uploadZone.addEventListener("drop", (e) => {
    e.preventDefault();
    uploadZone.classList.remove("drag-over");
    const file = e.dataTransfer.files[0];
    if (file) handleFile(file);
});

// -------- FILE PREVIEW --------
function handleFile(file) {
    if (!file.type.startsWith("image/")) {
        alert("Please upload a valid image file.");
        return;
    }
    if (file.size > 5 * 1024 * 1024) {
        alert("File size exceeds 5MB limit.");
        return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
        previewImg.src = e.target.result;
        imagePreview.style.display = "block";
        analyzeBtn.disabled = false;
        noResults.style.display = "none";
    };
    reader.readAsDataURL(file);
}

// -------- ANALYSIS SIMULATION --------
analyzeBtn.addEventListener("click", () => {
    const name = document.getElementById("userName").value.trim();
    const gender = document.getElementById("userGender").value;
    const age = document.getElementById("userAge").value;

    if (!name || !gender || !age) {
        alert("Please fill in Name, Gender, and Age before analyzing.");
        return;
    }

    // Save details for display
    displayName.textContent = name;
    displayGender.textContent = gender;
    displayAge.textContent = age;

    analyzeBtn.disabled = true;
    loadingIndicator.classList.add("show");
    resultsContainer.style.display = "none";

    // Simulate AI analysis
    setTimeout(() => {
        loadingIndicator.classList.remove("show");
        showResults();
        analyzeBtn.disabled = false;
    }, 2000);
});

function showResults() {
    resultsContainer.style.display = "block";
    userDetailsCard.style.display = "block";

    // Fake probabilities for demo
    const normalProb = Math.floor(Math.random() * 60) + 20; 
    const anemicProb = 100 - normalProb;

    let prediction = "";
    if (anemicProb > normalProb) {
        prediction = "Possible Anemia Detected";
        predictionResult.textContent = prediction;
        predictionResult.classList.remove("normal");
        predictionResult.classList.add("anemic");
    } else {
        prediction = "Normal";
        predictionResult.textContent = prediction;
        predictionResult.classList.remove("anemic");
        predictionResult.classList.add("normal");
    }

    const confidence = Math.max(normalProb, anemicProb);
    confidenceLevel.textContent = `Confidence: ${confidence}%`;

    normalBar.style.width = `${normalProb}%`;
    anemicBar.style.width = `${anemicProb}%`;
    normalPercentage.textContent = `${normalProb}%`;
    anemicPercentage.textContent = `${anemicProb}%`;

    // Fake features
    const features = {
        red_intensity: Math.floor(Math.random() * 255),
        brightness: Math.floor(Math.random() * 100),
        saturation: Math.floor(Math.random() * 100),
        contrast: Math.floor(Math.random() * 100)
    };

    featuresGrid.innerHTML = `
        <div class="feature-item"><div class="feature-label">Avg. Red Intensity</div><div class="feature-value">${features.red_intensity}</div></div>
        <div class="feature-item"><div class="feature-label">Brightness</div><div class="feature-value">${features.brightness}%</div></div>
        <div class="feature-item"><div class="feature-label">Saturation</div><div class="feature-value">${features.saturation}%</div></div>
        <div class="feature-item"><div class="feature-label">Contrast</div><div class="feature-value">${features.contrast}%</div></div>
    `;

    // -------- SAVE TO BACKEND (PHP + MySQL) --------
    const formData = new FormData();
    formData.append("name", document.getElementById("userName").value.trim());
    formData.append("gender", document.getElementById("userGender").value);
    formData.append("age", document.getElementById("userAge").value);
    formData.append("prediction", prediction);
    formData.append("confidence", confidence + "%");
    formData.append("normal_prob", normalProb);
    formData.append("anemic_prob", anemicProb);
    formData.append("features", JSON.stringify(features));

    // Attach uploaded image
    if (fileInput.files[0]) {
        formData.append("image", fileInput.files[0]);
    }

    fetch("save_results.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => console.log("Server Response:", data))
    .catch(err => console.error("Error:", err));
}
