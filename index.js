function searchPdfs() {
    const year = document.getElementById("year").value;
    const regulation = document.getElementById("regulation").value;
    const subject = document.getElementById("search").value.toLowerCase();

    fetch('get_pdfs.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `year=${encodeURIComponent(year)}&regulation=${encodeURIComponent(regulation)}&search=${encodeURIComponent(subject)}`
    })
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('pdf-container');
        container.innerHTML = '';

        if (!Array.isArray(data) || data.length === 0) {
            container.innerHTML = '<tr><td colspan="5">No PDFs match the search criteria.</td></tr>';
            return;
        }

        data.forEach(pdf => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${pdf.subject}</td>
                <td>${pdf.year}</td>
                <td>${pdf.regulation}</td>
                <td><a href="${pdf.file_path}" target="_blank">View PDF</a></td>
                <td>
                    <button onclick="editPdf(${pdf.id}, '${pdf.year}', '${pdf.regulation}', '${pdf.subject}', this)">✏️ Edit</button>
                    <button onclick="deletePdf(${pdf.id})">🗑️ Delete</button>
                </td>
            `;
            container.appendChild(row);
        });
    })
    .catch(error => console.error('Error fetching PDFs:', error));
}

function loadPdfs() {
    fetch('get_pdfs.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('pdf-container');
            container.innerHTML = '';

            if (!Array.isArray(data) || data.length === 0) {
                container.innerHTML = '<tr><td colspan="5">No PDFs available.</td></tr>';
                return;
            }

            data.forEach(pdf => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${pdf.subject}</td>
                    <td>${pdf.year}</td>
                    <td>${pdf.regulation}</td>
<td><button onclick="viewPDF('${pdf.file_path}')">View PDF</button></td>

                    <td>
                        <button onclick="editPdf(${pdf.id}, '${pdf.year}', '${pdf.regulation}', '${pdf.subject}', this)">✏️ Edit</button>
                        <button onclick="deletePdf(${pdf.id})">🗑️ Delete</button>
                    </td>
                `;
                container.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching PDFs:', error));
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("search-btn").addEventListener("click", searchPdfs);
    loadPdfs();
});


function editPdf(id, year, regulation, subject, button) {
    // Remove any existing popup or overlay
    const existingPopup = document.querySelector(".popup-container");
    const existingOverlay = document.querySelector(".popup-overlay");
    if (existingPopup) existingPopup.remove();
    if (existingOverlay) existingOverlay.remove();

    // Create overlay
    const overlay = document.createElement('div');
    overlay.className = "popup-overlay";
    overlay.style.position = "fixed";
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = "100vw";
    overlay.style.height = "100vh";
    overlay.style.background = "rgba(0, 0, 0, 0.4)";
    overlay.style.zIndex = "999";
    document.body.appendChild(overlay);

    // Create popup
    const popup = document.createElement('div');
    popup.className = "popup-container";
    popup.style.position = "fixed";
    popup.style.top = "50%";
    popup.style.left = "50%";
    popup.style.transform = "translate(-50%, -50%)";
    popup.style.background = "#fff";
    popup.style.border = "1px solid #ccc";
    popup.style.padding = "20px";
    popup.style.boxShadow = "0 0 15px rgba(0,0,0,0.3)";
    popup.style.zIndex = "1000";
    popup.style.borderRadius = "10px";
    popup.innerHTML = `
        <label>Select Year:</label><br>
        <select id="newYear">
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
        </select><br><br>

        <label>Select Regulation:</label><br>
        <select id="newRegulation">
            <option value="R20">R20</option>
            <option value="R23">R23</option>
        </select><br><br>

        <label>Enter Subject:</label><br>
        <input type="text" id="newSubject" value="${subject}" /><br><br>

        <button id="saveChanges">Save</button>
        <button id="cancel">Cancel</button>
    `;
    document.body.appendChild(popup);

    // Set selected values
    document.getElementById("newYear").value = year;
    document.getElementById("newRegulation").value = regulation;

    // Save changes
    document.getElementById("saveChanges").addEventListener("click", function () {
        const newYear = document.getElementById("newYear").value;
        const newRegulation = document.getElementById("newRegulation").value;
        const newSubject = document.getElementById("newSubject").value;

        if (newYear && newRegulation && newSubject) {
            fetch('edit_pdf.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${encodeURIComponent(id)}&year=${encodeURIComponent(newYear)}&regulation=${encodeURIComponent(newRegulation)}&subject=${encodeURIComponent(newSubject)}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                popup.remove();
                overlay.remove();
                loadPdfs(); // Reload table
            })
            .catch(error => console.error('Error editing PDF:', error));
        }
    });

    // Cancel button
    document.getElementById("cancel").addEventListener("click", function () {
        popup.remove();
        overlay.remove();
    });

    // Also close when clicking outside the popup
    overlay.addEventListener("click", function () {
        popup.remove();
        overlay.remove();
    });
}

function deletePdf(id) {
    if (confirm("Are you sure you want to delete this PDF?")) {
        fetch('delete_pdf.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${encodeURIComponent(id)}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            loadPdfs();
        })
        .catch(error => console.error('Error deleting PDF:', error));
    }
}

function viewPDF(pdfPath) {
    const container = document.getElementById("pdfViewerContainer");
    container.innerHTML = `
      <div style="position:fixed; top:0; left:0; width:100%; height:100%; background:#000000cc; display:flex; flex-direction:column; align-items:center; justify-content:center; z-index:9999;">
        <button onclick="closePDF()" style="margin-bottom:10px; padding:8px 16px; background:#ff4d4d; color:white; border:none; border-radius:5px; cursor:pointer;">Close</button>
        <iframe src="${pdfPath}" style="width:80%; height:80%; border:none; box-shadow: 0 0 10px rgba(0,0,0,0.5); border-radius:8px;"></iframe>
      </div>
    `;
  }
  
  function closePDF() {
    document.getElementById("pdfViewerContainer").innerHTML = "";
  }
  