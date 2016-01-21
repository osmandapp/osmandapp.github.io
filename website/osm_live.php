<html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 <!--
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"   integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
-->

<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
 
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel='stylesheet' href="site.css">
<link rel='stylesheet' href="reports/report.css">
<link rel='stylesheet' href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>
<script src="http://bootboxjs.com/bootbox.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/js/bootstrap-dialog.min.js"></script> 
<link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css" type="text/css" />

-->


  
<body>
<div class="maincontainer">
<div class="main">
<?php 
      $simpleheader_header = "OSM LIVE";
        include 'blocks/simple_header.php';
    ?>
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#report">OSM Contributions</a></li>
    <li><a  data-toggle="tab" href="#donate">Supporters</a></li>
    <li><a data-toggle="tab" href="#recipients">Recipients</a></li>    
  </ul>
  <div class="tab-content">
    <div id="report" class="tab-pane fade in active">
        <div class="report-period-group">
            <h4 class="vlabel" for="month-selection">Report period</h4>
            <select class="form-control" id="month-selection">
            </select>
            <h4 class="vlabel" for="region-selection">Region</h4>
            <select class="form-control" id="region-selection">
            </select>
        </div>
      <hr>
        <h4 class="vlabel" for="report-total-div">Overview</h4 >
        <div class="panel panel-default" id="report-total-div">
            <div class="panel-body"><p id="report-total"></p></div>
        </div>
      <hr>
          <h4 class="vlabel" for="report-table" id="report-ranking"></h4>
          <table id="report-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
          </table>
      <hr>
          <h4 class="vlabel" for="users-table" id="users-ranking"></h4>
          <table id="users-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
          </table>
    </div>
    <div id="donate" class="tab-pane fade ">
      <div class="report-period-group">
            <h4 class="vlabel" for="donate-month-selection">Report period</h4>
            <select class="form-control" id="donate-month-selection">
            </select>
        </div>
    </div>
    <div id="recipients" class="tab-pane fade ">
    </div>
  </div>
</div>

<?php include 'blocks/footer.html'; ?>
</div>
</div>

</body>
<script>
var mid = "";
var midName = "";
var region = "";
var regionName = "";
var regionsmap = {};


var floatFormat = function (o) { 
    var fl = parseFloat(o) * 100;
    return Math.round(fl) / 100.;
}

function regionDepth(region, regionsmap) {
  if(region.parentid in regionsmap) {
    return regionDepth(regionsmap[region.parentid], regionsmap) + 1;
  } else {
    return 0;
  }
}

function updateRegions() {
  $('#region-selection').empty();
  regionsmap = {};
  if(regionName.length > 0 && regionName != "Worldwide") {
    $("#region-selection").append("<option value='"+region+"'>"+regionName+"</option>"); 
  }
  $("#region-selection").append("<option value=''>Worldwide</option>"); 
  $.ajax({
      url: "reports/query_report.php?report=all_countries", 
      async: true
    }).done(function(res) {
      var data = jQuery.parseJSON( res );
      var namemap = {};
      for(i = 0; i < data.rows.length; i++) {
        var row = data.rows[i];
        regionsmap[data.rows[i].id] = data.rows[i];
        if(row.downloadname && row.map == "1" ) {
          var name = row.name;
          var depth = regionDepth(row, regionsmap);
          if(depth > 2 || (depth == 2 && regionsmap[row.parentid].name == "Russia")) {
            var parent = regionsmap[row.parentid];
            var parentparent = regionsmap[parent.parentid];
            if(depth == 3) {
              if(parentparent.name == "Russia") {
                name = parentparent.name + " " + name;
              } else if(parent.name != "United Kingdom"){
                name = parent.name + " " + name;
              }
            } else {
              // only england
              name = parent.name + " " + name;
            }
          } 
          namemap[name] = row.downloadname;
        }
    }
    var sorted_keys = Object.keys(namemap).sort()
    for(i = 0; i < sorted_keys.length; i++) {
      $("#region-selection").append("<option value='"+namemap[sorted_keys[i]]+"'>"+sorted_keys[i]+"</option>"); 
    }
  });
}

function updateTotalChanges() {
  $('#report-total').empty();
  $.ajax({
      url: "reports/query_report.php?report=total_changes_by_month&month="+mid+"&region="+region, 
      async: true
    }).done(function(res) {
      var data = jQuery.parseJSON( res );
      var html = "In total <strong>"+ data.changes + "</strong> changes were done by <strong>" 
        + data.users + "</strong> contributors";
      if(regionName.length > 0) {
         html = html + " in " + regionName;
      } 
      if(midName.length > 0) {
         html = html + " in " + midName;
      } 
      $('#report-total').html(html);
  });
}

var reportUserDataTable;
function updateUserRankingByMonth() {
  if(reportUserDataTable) {
    reportUserDataTable.destroy();
  }
  $('#users-ranking').text("Select region to see user statistics ");

  if(region.length > 0 ) {
    $.ajax({
        url: "reports/query_report.php?report=ranking_users_by_month&month="+mid+"&region="+region, 
        async: true
      }).done(function(res) {
        var data = jQuery.parseJSON( res );
        $('#users-ranking').text("Ranking of contributors");
        reportUserDataTable = $('#users-table').DataTable({
            data: data.rows,
            destroy: true,
            columns: [
                { "data": "rank", title: "Rank"},
                { "data": "user", title: "User name"},
                { "data": "changes", title: "Changes"}
            ],
            "paging":   true,
            "ordering": true,
            "iDisplayLength": 50,
            "info":     false,
            "searching": false
        });
    });
    }
}

var reportDataTable;
function updateRankingByMonth() {
  if(reportDataTable) {
    reportDataTable.destroy();
  }
  $('#report-ranking').empty();

  $.ajax({
      url: "reports/query_report.php?report=ranking_by_month&month="+mid+"&region="+region, 
      async: true
    }).done(function(res) {
      var data = jQuery.parseJSON( res );
      $('#report-ranking').text("Ranking of contributors by " + data.rows.length + " groups (made more than 3 changes)");
      reportDataTable = $('#report-table').DataTable({
          data: data.rows,
          destroy: true,
          columns: [
              { "data": "rank", title: "Group rank"},
              { "data": "countUsers", title: "Contributors in group"},
              { "data": "minChanges", title: "Minimum changes in group"},
              { "data": "maxChanges", title: "Maximum changes in group"},
              { "data": "avgChanges", title: "Average changes in group", render:floatFormat}
          ],
          "paging":   false,
          "ordering": true,
          //"iDisplayLength": 20,
          "info":     false,
          "searching": false
      });
  });
}

function formatYearMonthHuman(year, month) {
  var monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"];
  return monthNames[month - 1] + " " + year;
}

function formatYearMonth(year, month) {
  if(month < 10) {
    return year +"-0" +month;
  } else {
    return year +"-" +month;
  }
}


$(document).ready(function(){
  var currentTime = new Date();
  var month = currentTime.getMonth() + 1;
  var day = currentTime.getDate();
  var year = currentTime.getFullYear();
  mid = formatYearMonth(year, month);
  for(yi = 2015; yi <= year; yi++) {
    stmonth = yi == 2015? 8 : 1;
    endmonth = yi == year? month : 12;
    for(mi = stmonth; mi <= endmonth; mi++) {
      $("#month-selection").prepend("<option value='"+formatYearMonth(yi,mi)+"'>"+formatYearMonthHuman(yi,mi)+"</option>");
    }
  }
  for(yi = 2016; yi <= year; yi++) {
    stmonth = yi == 2016? 1 : 1;
    endmonth = yi == year? month : 12;
    for(mi = stmonth; mi <= endmonth; mi++) {
      $("#donate-month-selection").prepend("<option value='"+formatYearMonth(yi,mi)+"'>"+formatYearMonthHuman(yi,mi)+"</option>");
    }
  }
  if(typeof(Storage) !== "undefined") {
      if(sessionStorage.month) {
          mid = sessionStorage.month;
          midName = sessionStorage.monthName;
          $("#month-selection").val(mid);
      }
      if(sessionStorage.region) {
          region = sessionStorage.region;
          regionName = sessionStorage.regionName;
          $("#region-selection").val(region);
      }
  }
  

  updateRegions();
  updateTotalChanges();
  updateRankingByMonth();
  updateUserRankingByMonth();
    $('#month-selection').on('change', function (e) {
      var optionSelected = $("option:selected", this);
      mid = this.value;
      midName = optionSelected.text();
      if(typeof(Storage) !== "undefined") {
        sessionStorage.month = mid;
        sessionStorage.monthName = midName;
      }
      updateTotalChanges();
      updateRankingByMonth();
      updateUserRankingByMonth();
    });

    $('#region-selection').on('change', function (e) {
      var optionSelected = $("option:selected", this);
      region = this.value;
      regionName = optionSelected.text();
      if(typeof(Storage) !== "undefined") {
        sessionStorage.region = region;
        sessionStorage.regionName = regionName;
      }
      
      updateTotalChanges();
      updateRankingByMonth();
      updateUserRankingByMonth();
    });
    
   
});
</script>

</html>