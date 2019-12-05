$(document).ready(function() {
  table = null;
  table = $("#verify-table").DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent: "<button>Verify</button>"
      }
    ]
  });

  $("#verify-table tbody").on("click", "button", function() {
    var rowData = table.row($(this).parents("tr")).data();
    var tag = rowData[0];
    $.ajax({
      type: "POST",
      url: "home-process.php",
      data: { tag: tag }
    });
  });

  var ctxP = document.getElementById("laptops").getContext("2d");
  var myPieChart = new Chart(ctxP, {
    type: "pie",
    data: {
      labels: ["Active " + AL, "Not Active " + SL],
      datasets: [
        {
          data: [AL, SL],
          backgroundColor: ["#00cc66", "#cc0000"],
          hoverBackgroundColor: ["#00cc66", "#cc0000"]
        }
      ]
    },
    options: {
      responsive: true
    }
  });

  var ctxP = document.getElementById("tablets").getContext("2d");
  var myPieChart = new Chart(ctxP, {
    type: "pie",
    data: {
      labels: ["Active " + AT, "Not Active " + ST],
      datasets: [
        {
          data: [AT, ST],
          backgroundColor: ["#00cc66", "#cc0000"],
          hoverBackgroundColor: ["#00cc66", "#cc0000"]
        }
      ]
    },
    options: {
      responsive: true
    }
  });

  var ctxP = document.getElementById("desktops").getContext("2d");
  var myPieChart = new Chart(ctxP, {
    type: "pie",
    data: {
      labels: ["Active " + AD, "Not Active " + SD],
      datasets: [
        {
          data: [AD, SD],
          backgroundColor: ["#00cc66", "#cc0000"],
          hoverBackgroundColor: ["#00cc66", "#cc0000"]
        }
      ]
    },
    options: {
      responsive: true
    }
  });

  var ctxP = document.getElementById("video-conferencing").getContext("2d");
  var myPieChart = new Chart(ctxP, {
    type: "pie",
    data: {
      labels: ["Active " + AVC, "Not Active " + SVC],
      datasets: [
        {
          data: [AVC, SVC],
          backgroundColor: ["#00cc66", "#cc0000"],
          hoverBackgroundColor: ["#00cc66", "#cc0000"]
        }
      ]
    },
    options: {
      responsive: true
    }
  });

  var ctxP = document.getElementById("printers").getContext("2d");
  var myPieChart = new Chart(ctxP, {
    type: "pie",
    data: {
      labels: ["Active " + AP, "Not Active " + SP],
      datasets: [
        {
          data: [AP, SP],
          backgroundColor: ["#00cc66", "#cc0000"],
          hoverBackgroundColor: ["#00cc66", "#cc0000"]
        }
      ]
    },
    options: {
      responsive: true
    }
  });
});
