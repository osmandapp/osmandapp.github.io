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
    <li  class="active"><a data-toggle="tab" href="#information">Information</a></li>    
    <li><a data-toggle="tab" href="#report">OSM Contributions</a></li>
    <li><a  data-toggle="tab" href="#donate">Supporters</a></li>
    <li><a data-toggle="tab" href="#recipients">Recipients</a></li>    
  </ul>
  <div class="tab-content">
    <div id="report" class="tab-pane fade">
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
            <div class="panel-body"><p id="report-total" class="infobox"></p></div>
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
            <select class="form-control osm-live-month-select" id="donate-month-selection">
            </select>
            <hr>
            <h4 class="vlabel" for="donator-report-total-div">Overview</h4 >
            <div class="panel panel-default" id="donator-report-total-div">
                <div class="panel-body"><p id="donator-report-total" class="infobox"></p></div>
            </div>
            <hr>
            <h4 class="vlabel" for="support-table" id="support-table-header">OSM Live donators</h4>
            <table id="support-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            </table>

        </div>
    </div>
    <div id="information" class="tab-pane fade in active">
      <h4 class="vlabel" for="general-info-div">Information</h4 >
        <div class="panel panel-default" id="general-info-div">
            <div class="panel-body"><p id="general-info" class="infobox"></p></div>
        </div>
        <hr>
        <h4 class="vlabel" for="recipients-register-div">Register as a recipient</h4 >
        <div class="panel panel-default" id="recipients-register-div">
            <div class="panel-body">
            <div class="alert alert-danger" role="alert" id="osm_register_failed" style="display:none">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
               OSM Authentication has failed.
            </div>
            <div class="alert alert-success" role="alert" id="osm_register_success" style="display:none">
              <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> 
              You successfully registered as a recipient.
            </div>
            <form role="form" action="subscription/register_osm.php" method="post" id="register_osm">

                <label for="osm_usr">OSM Name:</label>
                <input type="text" class="form-control" id="osm_usr" name="osm_usr">
                <label for="osm_pwd">OSM Password (we do not store it on servers):</label>
                <input type="password" class="form-control" id="osm_pwd" name="osm_pwd">
                <label for="bitcoin_addr">Bitcoin address:</label>
                <input type="text" class="form-control" id="bitcoin_addr" name="bitcoin_addr">
                <button type="submit" class="btn btn-default" id="register_osm_user">Register</button>
            </form>
              
            </div>
        </div>
    </div>
    <div id="recipients" class="tab-pane fade ">
      <h4 class="vlabel" for="general-info-div">Information</h4 >
        <div class="panel panel-default" id="general-info-div">
            <div class="panel-body"><p id="general-info" class="infobox"></p></div>
        </div>
        <hr>
        <h4 class="vlabel" for="recipients-month-selection">Report period</h4>
            <select class="form-control osm-live-month-select" id="recipients-month-selection">
            </select>
          <hr>
       <h4 class="vlabel" for="recipients-table" id="recipients-table-header">OSM Recipients</h4>
        <table id="recipients-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        </table>
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
var supportMonth = "";
var supportMonthName = "";
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

function skuApp(value) {
  if(value == "osm_live_subscription_1" || value == "osm_live_subscription_2") {
    return "OsmAnd+";
  }
  if(value == "osm_free_live_subscription_1" || value == "osm_free_live_subscription_2") {
    return "OsmAnd";
  }
  return "-";
}

var reportRecipientsDataTable;
function updateRecipientsByMonth() {
  if(reportRecipientsDataTable) {
    reportRecipientsDataTable.destroy();
  }
  $.ajax({
        url: "reports/query_report.php?report=recipients_by_month&month="+supportMonth, 
        async: true
  }).done(function(res) {
        reportRecipientsDataTable = $('#recipients-table').DataTable({
            data: data.rows,
            destroy: true,
            columns: [
                { "data": "osmid", title: "OSM ID"},
                { "data": "btcaddress", title: "Bitcoin Address"}
            ],
            "paging":   true,
            "ordering": true,
            "iDisplayLength": 50,
            "info":     false,
            "searching": true
        });
  });
}


var reportSupportDataTable;
function updateSupportByMonth() {
  if(reportSupportDataTable) {
    reportSupportDataTable.destroy();
  }
  $.ajax({
        url: "reports/query_report.php?report=supporters_by_month&month="+supportMonth, 
        async: true
  }).done(function(res) {
        var data = jQuery.parseJSON( res );
        $('#donator-report-total').html("There are <strong>" + data.activeCount + 
            "</strong> active donors and <strong>" + data.count +"</strong> registered supporters." );

        reportSupportDataTable = $('#support-table').DataTable({
            data: data.rows,
            destroy: true,
            columns: [
                { "data": "user", title: "User name"},
                { "data": "sku", title: "Application", render: skuApp},
                // { "data": "autorenew", title: "Autorenew"},
                { "data": "status", title: "Status"}
            ],
            "paging":   true,
            "ordering": true,
            "iDisplayLength": 50,
            "info":     false,
            "searching": true
        });
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
                { "data": "rank", title: "Region rank"},
                { "data": "grank", title: "World rank"},
                { "data": "user", title: "User name"},        
                { "data": "changes", title: "Region changes"},
                { "data": "globalchanges", title: "All changes"}
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

              { "data": "rank", title: "Rank"},
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

function updateGeneralInfo() {
  $("#general-info").html("UNDER CONSTRUCTION<br>OsmAnd heavily relies on OSM and its community. Honestly saying, OsmAnd won't exist without it and it is even stated in the name."+
    "When we started implementation OSM Live, we immediately decided that should be not only a paid service, but a donation platform as well. " +
    "Taking into account that OSM Live is possible only because 10000 contributors change the map every day, we want to distribute a part of the income between OSM editors. " +
    "<br><br><strong>How it works</strong><ul>" +
    "<li> Every OSM contributor can be registered as a recipient. He just need to provide a valid Bitcoin address in the form below. " +
    "<li> Every OsmAnd user who wants to get live updates needs to subscribe to that service. " +
    "<li> After Google and Bank deductions the whole sum is split into 2 parts (<strong>30% OsmAnd</strong> and <strong>70% Donations</strong>)"+
    "<li> All donations are exchanged into Bitcoin and distributed between OSM contributors according to their ranking."+
    "<li> Every OsmAnd user can select preferred donation region, in that case <strong>30% of donation</strong> will be distributed between editors of this region."+
    "</ul><br> Please find all rankings and formulas in the reports on OSM Live.")
}

function handleRegisterOsm() {

  $( "#register_osm" ).submit(function( event ) {
      event.preventDefault();
        if($("#bitcoin_addr").val() == "") {
          $("#osm_register_failed").html("Please specify correct bitcoin address");
          $("#osm_register_failed").fadeIn(100);
          return;
      }

      $.post("subscription/register_osm.php", $("#register_osm").serialize(), function(res) {
          if (res == "OK") {
            $("#osm_register_success").fadeIn(100);
          }
          $("#osm_register_failed").html(res);
          $("#osm_register_failed").fadeIn(100);
          var data = jQuery.parseJSON( res );
          if (data.error) {
            $("#osm_register_failed").fadeIn(100);
            $("#osm_register_failed").html(data.error);
          } else {
            $("#osm_register_failed").fadeOut(0);
            $("#osm_register_success").fadeIn(100); 
          }
         
      });
  });
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
      $(".osm-live-month-select").prepend("<option value='"+formatYearMonth(yi,mi)+"'>"+formatYearMonthHuman(yi,mi)+"</option>");
    }
  }
  if(typeof(Storage) !== "undefined") {
    if(sessionStorage.supportMonth) {
          supportMonth = sessionStorage.supportMonth;
          supportMonthName = sessionStorage.supportMonthName;
          $(".osm-live-month-select").val(supportMonth);
      }
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
  handleRegisterOsm();
  updateGeneralInfo();
  updateSupportByMonth();
  updateRecipientsByMonth();
  updateRegions();
  updateTotalChanges();
  updateRankingByMonth();
  updateUserRankingByMonth();
  $('.osm-live-month-select').on('change', function (e) {
      var optionSelected = $("option:selected", this);
      supportMonth = this.value;
      supportMonthName = optionSelected.text();
      if(typeof(Storage) !== "undefined") {
        sessionStorage.supportMonth = supportMonth;
        sessionStorage.supportMonthName = supportMonthName;
      }
      updateSupportByMonth();
      updateRecipientsByMonth();
  });

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

// bitcoin addr validation
function check(address) {
  var decoded = base58_decode(address);     
  if (decoded.length != 25) return false;

  var cksum = decoded.substr(decoded.length - 4); 
  var rest = decoded.substr(0, decoded.length - 4);  

  var good_cksum = hex2a(sha256_digest(hex2a(sha256_digest(rest)))).substr(0, 4);

  if (cksum != good_cksum) return false;
  return true;
}

function base58_decode(string) {
  var table = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
  var table_rev = new Array();

  var i;
  for (i = 0; i < 58; i++) {
    table_rev[table[i]] = int2bigInt(i, 8, 0);
  } 

  var l = string.length;
  var long_value = int2bigInt(0, 1, 0);  

  var num_58 = int2bigInt(58, 8, 0);

  var c;
  for(i = 0; i < l; i++) {
    c = string[l - i - 1];
    long_value = add(long_value, mult(table_rev[c], pow(num_58, i)));
  }

  var hex = bigInt2str(long_value, 16);  

  var str = hex2a(hex);  

  var nPad;
  for (nPad = 0; string[nPad] == table[0]; nPad++);  

  var output = str;
  if (nPad > 0) output = repeat("\0", nPad) + str;

  return output;
}

function hex2a(hex) {
    var str = '';
    for (var i = 0; i < hex.length; i += 2)
        str += String.fromCharCode(parseInt(hex.substr(i, 2), 16));
    return str;
}

function a2hex(str) {
    var aHex = "0123456789abcdef";
    var l = str.length;
    var nBuf;
    var strBuf;
    var strOut = "";
    for (var i = 0; i < l; i++) {
      nBuf = str.charCodeAt(i);
      strBuf = aHex[Math.floor(nBuf/16)];
      strBuf += aHex[nBuf % 16];
      strOut += strBuf;
    }
    return strOut;
}

function pow(big, exp) {
    if (exp == 0) return int2bigInt(1, 1, 0);
    var i;
    var newbig = big;
    for (i = 1; i < exp; i++) {
        newbig = mult(newbig, big);
    }

    return newbig;
}

function repeat(s, n){
    var a = [];
    while(a.length < n){
        a.push(s);
    }
    return a.join('');
}
</script>

</html>