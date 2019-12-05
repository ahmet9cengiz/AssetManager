$(document).ready(function() {
  table = null;
  table = $("#all-items").DataTable({});

  $(function() {
    $("#purchase-date").datepicker();
  });

  $("#tabs").tabs({
    collapsible: true
  });

  //Add Asset
  $("#add-category, #add-manufacturer").change(function() {
    var categoryIDs = $("#add-category").val();
    var manufacturerIDs = $("#add-manufacturer").val();
    $.ajax({
      url: "inc/dynamicDropdown.php",
      method: "POST",
      data: { categoryID: categoryIDs, manufacturerID: manufacturerIDs }
    }).done(function(models) {
      models = JSON.parse(models);
      $("#model").empty();
      $("#model").append(
        '<option disabled = "" selected = "">Select Model</option>'
      );
      models.forEach(function(model) {
        $("#model").append(
          '<option value = "' +
            model.ModelNumber +
            '" >' +
            model.ModelNumber +
            "</option>"
        );
      });
    });
  });

  //Update asset
  $("#old-category, #old-manufacturer").change(function() {
    var categoryIDs = $("#old-category").val();
    var manufacturerIDs = $("#old-manufacturer").val();
    $.ajax({
      url: "inc/dynamicDropdown.php",
      method: "POST",
      data: { categoryID: categoryIDs, manufacturerID: manufacturerIDs }
    }).done(function(models) {
      console.log(models);
      models = JSON.parse(models);
      $("#old-model").empty();
      $("#old-model").append(
        '<option disabled = "" selected = "">Select Model</option>'
      );
      models.forEach(function(model) {
        $("#old-model").append("<option>" + model.ModelNumber + "</option>");
      });
    });
  });

  $("#new-category, #new-manufacturer").change(function() {
    var categoryIDs = $("#new-category").val();
    var manufacturerIDs = $("#new-manufacturer").val();
    $.ajax({
      url: "inc/dynamicDropdown.php",
      method: "POST",
      data: { categoryID: categoryIDs, manufacturerID: manufacturerIDs }
    }).done(function(models) {
      console.log(models);
      models = JSON.parse(models);
      $("#new-model").empty();
      $("#new-model").append(
        '<option disabled = "" selected = "">Select Model</option>'
      );
      models.forEach(function(model) {
        $("#new-model").append("<option>" + model.ModelNumber + "</option>");
      });
    });
  });

  //Delete Asset
  $("#del-category, #del-manufacturer").change(function() {
    var categoryIDs = $("#del-category").val();
    var manufacturerIDs = $("#del-manufacturer").val();
    $.ajax({
      url: "inc/dynamicDropdown.php",
      method: "POST",
      data: { categoryID: categoryIDs, manufacturerID: manufacturerIDs }
    }).done(function(models) {
      console.log(models);
      models = JSON.parse(models);
      $("#del-model").empty();
      $("#del-model").append(
        '<option disabled = "" selected = "">Select Model</option>'
      );
      models.forEach(function(model) {
        $("#del-model").append("<option>" + model.ModelNumber + "</option>");
      });
    });
  });
});
