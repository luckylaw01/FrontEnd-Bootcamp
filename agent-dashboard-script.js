
    var currentPatentId; // Store current patent ID for update

    function openModal(date, patentCountry, applicantName, patentTitle, patentField, patentId, patentBlockchainID, patentApplicant2Email, patentApplicant3Email, patentApplicant4Email, patentApprovalDate, patentApprovalAgentId, patentApprovalStatus, patentDescription, patentDrwawings, patentVideoLink, patentAbstract, patentReferences){
        // Access the modal
        var modal = document.getElementById("myModal");
        
        // Access the content area of the modal
        var modalContent = document.getElementById("modalContent");

        // Other Applicants Names

        
        
        // Set the content of the modal

        modalContent.innerHTML = `
        <h3>Basic Details</h3>
        <div class="basic-details">
        
            <p>Patent Application Date <span>${date}</span></p>
            <p>Patent Field<span>${patentField}</span></p>
            <p>Country of Application <span>${patentCountry}</span></p>
            <p>Applicant Full Name <span>${applicantName}</span></p>
        </div>
        <div class="patent-title">
            <p>Patent title</p>
            <h2>${patentTitle}</h2>
        </div>
        <div class="desc">
            <p class="desc-head">Patent Description</p>
            <p class="desc-details">${patentDescription}</p>
        </div>
        <div class="other-info">
            <h3>Other Information</h3>
            <div class="other-applicants">
                <h4>Other Applicants</h4>
                <p class="other-applicant-name">${patentApplicant2Email? patentApplicant2Email.substring(0, patentApplicant2Email.indexOf('@')): ''}, <span> Kenya</span></p>
                <p class="other-applicant-name">${patentApplicant3Email.substring(0, patentApplicant2Email.indexOf('@'))}, <span> Kenya</span></p>
                <p class="other-applicant-name">${patentApplicant4Email.substring(0, patentApplicant2Email.indexOf('@'))}, <span> Kenya</span></p>
            </div>
            <div class="patent-abstract">
                <h3>Abstract</h3>
                <p>${patentAbstract}</p>
            </div>
            <div class="patent-drawings">
                <h4>Diagrams and drawings</h4>
                <img src="images/writting.jpg" alt="">
            </div>
            <div class="patent-video">
                <h3>Watch the video</h3>
                <iframe id="iframe-video" width="560" height="315" src="http://www.youtube.com/watch?v=" title="PUBLIC DOMAIN Fine Prints (Etchings & Drawings)  Illustrations" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        `

        document.getElementById('iframe-video').src = patentVideoLink;
        
        // Store the current patent ID for update
        currentPatentId = patentId;
        patentField = patentField;
        // Display the modal
        modal.style.display = "block";
    }
    
    function closeModal() {
        // Access the modal
        var modal = document.getElementById("myModal");
        
        // Close the modal
        modal.style.display = "none";
    }

    function reject() {
    var rejectionReason = document.getElementById("rejectionReason").value;
    var reviewNotes = document.getElementById("reviewNotes").value;

    // Make AJAX request to update the database
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Database updated successfully
            console.log(this.responseText);
            modalContent.innerHTML = `<h1> You have rjected this patent. The applicant will be notified Immediately. Your review notes and reason for rejection will also be shared`;
            document.getElementById('rejectButton').style.display = 'none';
            document.getElementById('approveButton').style.display = 'none';
            document.getElementById('agentChecklist').style.display = 'none';
            document.getElementById('agentNotes').style.display = 'none';
            document.querySelector('.request').style.display = 'none';
            alertNow("Success! The query was executed successfully");
        }
    };
    xhttp.open("POST", "includes/update-database.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("patentId=" + currentPatentId + "&status=rejected&rejectionReason=" + encodeURIComponent(rejectionReason) + "&reviewNotes=" + encodeURIComponent(reviewNotes));
}

function approve() {
    var reviewNotes = document.getElementById("reviewNotes").value;

    // Make AJAX request to update the database
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Database updated successfully
            console.log(this.responseText);
            modalContent.innerHTML = `<h1> You have successfully approved this patent. It will be sumitted to the International IP organization for BlockChaining`;
            document.getElementById('rejectButton').style.display = 'none';
            document.getElementById('approveButton').style.display = 'none';
            document.getElementById('agentChecklist').style.display = 'none';
            document.getElementById('agentNotes').style.display = 'none';
            document.querySelector('.request').style.display = 'none';
            alertNow("Success! The query was executed successfully");
        }
    };
    xhttp.open("POST", "includes/update-database.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("patentId=" + currentPatentId + "&status=approved&rejectionReason=" + encodeURIComponent(rejectionReason) + "&reviewNotes=" + encodeURIComponent(reviewNotes));

}



function alertNow(message){
    const animatedAlert = document.querySelector(".animated-alert");
    animatedAlert.style.display = "block";
    animatedAlert.textContent = message;
                
                setTimeout(() => {
                    document.querySelector(".animated-alert").style.display = "none";
            }, 5000);

    }