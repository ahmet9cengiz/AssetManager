$(document).ready(function() {
  $("#tabs").tabs({
    collapsible: true
  });

  $("#gen-firstname, #gen-lastname").change(function() {
    var firstnameVal = $("#gen-firstname").val();
    var lastnameVal = $("#gen-lastname").val();
    if (firstnameVal == lastnameVal) {
      $.ajax({
        url: "inc/dynamicDropdown.php",
        method: "POST",
        data: { userID: firstnameVal }
      }).done(function(emails) {
        emails = JSON.parse(emails);
        $("#gen-email").empty();
        $("#gen-email").append(
          '<option disabled = "" selected = "">Select Email</option>'
        );
        emails.forEach(function(email) {
          $("#gen-email").append(
            '<option value = "' +
              email.userID +
              '" >' +
              email.email +
              "</option>"
          );
        });
      });
    } else {
      //mismatch do nothing
    }
  });

  $("#menu").menu();
  $("#generate").click(generatePdf);

  function generatePdf() {
    var firstname = $("#gen-firstname :selected").text();
    if (firstname == "Select First Name") {
      firstname = "";
    }
    var lastname = $("#gen-lastname :selected").text();
    if (lastname == "Select Last Name") {
      lastname = "";
    }
    var name = firstname + " " + lastname;
    var email = $("#gen-email :selected").text();
    if (email == "Select Email") {
      email = "";
    }
    var purpose = $("#gen-purpose :selected").text();
    if (purpose == "Select Purpose") {
      purpose = "";
    }
    var serviceTag = $("#gen-service-tag :selected").text();
    if (serviceTag == "Select Service Tag") {
      serviceTag = "";
    }
    var loanDate = $("#gen-loan-date").val();
    var dateArray = loanDate.split("-");
    if (dateArray[0] == "") {
      loanDate = "";
    } else {
      loanDate = dateArray[1] + "/" + dateArray[2] + "/" + dateArray[0];
    }
    var returnDate = "";

    var doc = new jsPDF();

    var imageData =
      "data:image/gif;base64,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";

    doc.addImage(imageData, 10, -10);

    var titleFirst = "Information Technology &";
    var titleSecond = "Instruction Equipment Loan Form";

    doc.setFontStyle("bold");
    doc.text(100, 30, titleFirst);
    doc.text(100, 40, titleSecond);

    var line1 =
      "The equipment listed below is the property of Indiana University – School of Education at IUPUI";
    var line2 =
      "and is being loaned for the time period and to the person indicated below.";

    doc.setFontSize(12);
    doc.setFontStyle("normal");
    doc.text(10, 60, line1);
    doc.text(10, 67, line2);

    var lineSubtitle1 = "User Information";
    var lineSubtitle2 = "Equipment Information";

    var line3 = "Faculty-Staff Member Name:";
    var line4 = "Email Address:";
    var line5 = "Purpose:";
    var line6 = "Service Tag:";
    var line7 = "Loan Date:";
    var line8 = "Return Date:";

    var line9 =
      "I understand that the following conditions will apply to all equipment:";
    var line10 = "a. It will only be used by me for school related activity;";
    var line11 =
      "b. I assume liability for damage or theft and will be responsible for the repair or replacement costs";
    var line12 =
      "of each item (I will consult my personal homeowners or auto insurance coverage policies);";
    var line13 =
      "c. I will not store any confidential or sensitive information as defined by the IU Security Office";
    var line14 =
      "policy on the equipment, http://protect.iu.edu/cybersecurity/data ;";
    var line15 =
      "d. I will report the loss or theft of the equipment immediately to Education Technology Services;";
    var line16 = "e. I will exercise reasonable care in its transport and use;";
    var line17 =
      "f.  I will return the equipment on the agreed Return Date/Time indicated above OR immediately";
    var line18 =
      "prior to terminating employment with IU School of Education at IUPUI OR upon the request of";
    var line19 = "Education Technology Services.";

    var line20 =
      "Faculty-Staff Member Signature: __________________________________  Date: __/__/____";
    var line21 =
      "APPROVAL: ___________________________________________________  Date: __/__/____";
    var line22 = "(Education Technology Services Staff Signature)";

    var line23 =
      "The item has been returned and inspected for damages. Damages are noted as follows:";
    var line24 =
      "Signature of ETS Staff Checking in: __________________________  Date: __/__/____";

    doc.setFontStyle("bold");
    doc.setFontSize(15);
    doc.text(15, 80, lineSubtitle1);
    doc.setFontSize(12);
    doc.text(15, 95, line3);
    doc.text(15, 105, line4);
    doc.text(15, 115, line5);

    doc.setFontStyle("normal");
    doc.text(90, 95, name);
    doc.text(90, 105, email);
    doc.text(90, 115, purpose);

    doc.setFontStyle("bold");
    doc.setFontSize(15);
    doc.text(15, 130, lineSubtitle2);
    doc.setFontSize(12);
    doc.text(15, 145, line6);
    doc.text(15, 155, line7);
    doc.text(15, 165, line8);

    doc.setFontStyle("normal");
    doc.text(90, 145, serviceTag);
    doc.text(90, 155, loanDate);
    doc.text(90, 165, returnDate);

    doc.setFontStyle("bold");
    doc.text(10, 180, line9);

    doc.setFontStyle("normal");
    doc.text(15, 190, line10);
    doc.text(15, 197, line11);
    doc.text(20, 204, line12);
    doc.text(15, 211, line13);
    doc.text(20, 218, line14);
    doc.text(15, 225, line15);
    doc.text(15, 232, line16);
    doc.text(15, 239, line17);
    doc.text(20, 246, line18);
    doc.text(20, 253, line19);

    doc.setFontStyle("bold");
    doc.text(10, 263, line20);
    doc.text(10, 270, line21);

    doc.setFontStyle("normal");
    doc.setFontSize(8);
    doc.text(70, 274, line22);

    doc.setFontSize(12);
    doc.text(10, 280, line23);
    doc.setFontStyle("bold");
    doc.text(10, 287, line24);

    doc.save("LoanAgreement.pdf");
  }
});
