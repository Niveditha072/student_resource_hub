<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student PDF Resource Hub</title>
  <link rel="icon" href="img/favicon_io/favicon.ico1" type="image/x-icon">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }
    body {
      background: linear-gradient(to right,#e6f0ff,#e6f0ff);
      color: white;
      text-align: center;
      padding: 20px;
    }
    header {
      background:#003366;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    #search-section {
      background: #003366;
      padding: 20px;
      border-radius: 10px;
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    select, input, button {
      padding: 10px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
    }
    button {
      background: #0066CC;
      color: white;
      cursor: pointer;
    }
    button:hover {
      background: #0066CC;
    }
    #pdf-list {
      background: white;
      padding: 20px;
      border-radius: 10px;
      margin-top: 20px;
    }
    #results {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }
    .pdf-card {
  background: #e1f5fe;
  padding: 15px;
  border-radius: 10px;
  text-align: center;
  color: black; /* 👈 Add this line */
}

    .pdf-preview {
      width: 100%;
      height: 150px;
      border: none;
      border-radius: 5px;
      margin-bottom: 10px;
      transition: transform 0.2s ease-in-out;
    }
    .pdf-preview.not-supported {
      height: 150px;
      background: #ddd;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      color: #333;
      border: 1px dashed #aaa;
      border-radius: 6px;
      margin-bottom: 10px;
    }
    .pdf-preview:hover {
      transform: scale(1.05);
    }
    .button-group button {
      display: block;
      width: 100%;
      margin: 5px 0;
      padding: 8px;
      background: #0066CC;
      border: none;
      border-radius: 5px;
      color: white;
      cursor: pointer;
    }
    .button-group button:hover {
      background: #0066CC;
    }
    .pdf-fullscreen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.9);
      display: none;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      z-index: 1000;
    }
    .pdf-fullscreen iframe {
      width: 80%;
      height: 80%;
      border-radius: 10px;
    }
    .close-btn {
      background:#0066CC;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 18px;
      cursor: pointer;
      margin-top: 10px;
    }
    header img {
      float: left;
      margin-right: 20px;
      height: 60px;
   }
  </style>
</head>
<body>
  <header>
  <img src="img/logo.jpg" alt="Logo" style="height: 60px; margin-right: 20px;">
    <h1>Student PDF Resource Hub</h1>
    <p>Search, view, and download your study materials</p>
  </header>

  <section id="search-section">
    <input type="text" id="searchInput" placeholder="Search by Subject">
    <div id="suggestions" style="position: absolute; background: white; color: black; z-index: 100; width: 250px; border-radius: 5px; overflow: hidden; display: none;"></div>

    <select id="yearSelect">
      <option value="">All Years</option>
      <option value="1st Year">1st Year</option>
      <option value="2nd Year">2nd Year</option>
      <option value="3rd Year">3rd Year</option>
      <option value="4th Year">4th Year</option>
    </select>
    <select id="regSelect">
      <option value="">All Regulations</option>
      <option value="R20">R20</option>
      <option value="R21">R21</option>
      <option value="R23">R23</option>
    </select>
    <button onclick="fetchPDFs()">Search</button>
  </section>

  <section id="pdf-list">
    <ul id="results"></ul>
  </section>

  <div id="pdfViewer" class="pdf-fullscreen">
    <iframe id="pdfFrame"></iframe>
    <button class="close-btn" onclick="closePDF()">Close</button>
  </div>

  <script>
   

    function fetchPDFs() {
      const formData = new FormData();
      formData.append('search', document.getElementById('searchInput').value);
      formData.append('year', document.getElementById('yearSelect').value);
      formData.append('regulation', document.getElementById('regSelect').value);

      fetch('fetch_student_pdfs.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        const results = document.getElementById('results');
        results.innerHTML = '';

        if (data.length === 0) {
          results.innerHTML = "<li style='color: yellow;'>No PDFs found. Try a different search.</li>";
          return;
        }

        data.forEach(pdf => {
          const card = document.createElement('div');
          card.className = 'pdf-card';
          const isPDF = pdf.file_path.toLowerCase().endsWith('.pdf');

          const encodedPath = encodeURIComponent(pdf.file_path);
          const fileName = pdf.file_path.split('/').pop();

          card.innerHTML = `
            ${isPDF
              ? `<iframe src="${pdf.file_path}" class="pdf-preview"></iframe>`
              : `<div class="pdf-preview not-supported">📄 Word File - No Preview</div>`}
            <p><strong>${pdf.subject}</strong></p>
            <p>${pdf.year} | ${pdf.regulation}</p>
            <div class="button-group">
              <button onclick="viewFile('${pdf.file_path}')">👁 View</button>
              <form method="GET" action="download.php">
             <input type="hidden" name="file" value="${fileName}">
             <button type="submit">⬇️ Download</button>
              </form>
            </div>
          `;

          results.appendChild(card);
        });
      })
      .catch(err => {
        document.getElementById('results').innerHTML = `<li style="color:red;">Error loading PDFs: ${err.message}</li>`;
      });
    }

    function viewFile(filePath) {
  const isPDF = filePath.toLowerCase().endsWith('.pdf');
  if (isPDF) {
    openPDF(filePath); // opens in fullscreen overlay
  } else {
    window.open(filePath, '_blank'); // just open the .docx in a new browser tab
  }
}


    function openPDF(pdfUrl) {
      const viewer = document.getElementById('pdfViewer');
      document.getElementById('pdfFrame').src = pdfUrl;
      viewer.style.display = 'flex';
    }

    function closePDF() {
      document.getElementById('pdfViewer').style.display = 'none';
      document.getElementById('pdfFrame').src = '';
    }

    window.onload = fetchPDFs;
  </script>
  <section id="development-team" style="padding: 20px; background-color: #f0f4ff; border-radius: 12px; margin-top: 40px;">
    <h2 style="text-align: center; color: #333;">💻 Development Team</h2>
    <ul style="list-style: none; padding: 0; text-align: center; font-size: 18px; color: #555;">
      <li>👤 K.Dolly Ganya</li>
      <li>👤 D.Niveditha</li>
    </ul>
  </section>
</body>
</html>
