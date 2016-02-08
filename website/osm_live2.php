<html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel='stylesheet' href="site.css">
 
<body>
<div class="maincontainer">
<div class="main">
<?php 
      $simpleheader_header = "OSM LIVE";
        include 'blocks/simple_header.php';
    ?>
<div class="container osmlive">
<div class="submenucontainer">
  <ul class="submenu">
    <li class="active">INFORMATION</li>    
    <li>OSM CONTRIBUTIONS</li>
    <li>SUPPORTERS</li>
    <li>RECIPIENTS</li>    
  </ul>
  <div class="clear"></div>
  </div>
  <div class="articles">
  <div class="articlescontainer">
 
   <!-- <div id="report" class="tab-pane fade">
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
    </div>-->
    <div id="information" class="article">
      <h1>About OSM Live</h1>
      <p>OsmAnd heavily relies on OSM and its community. Honestly saying, OsmAnd wouldn't exist without that great community.
           When we started implementation OSM Live, we immediately decided that it should not be only a paid service, but a donation service as well.
           Thinking that OSM Live is only possible because thousands of edits every hour in many places of the world, we want to distribute a part of the income between OSM editors.</p> 
      <h3>How it works</h3>
	  <ul>
        <li> Every OSM contributor can be registered as a recipient. He just need to provide a valid Bitcoin address in the form below.</li>
        <li> Every OsmAnd user who wants to get live updates needs to subscribe to that service.</li>
        <li> After Google and Bank deductions the whole sum is split into 2 parts (<strong>30% OsmAnd</strong> and <strong>70% Donations</strong>)</li>
        <li> All donations are exchanged into Bitcoin and distributed between OSM contributors according to their ranking.</li>
        <li> Every OsmAnd user can select preferred donation region, in that case <strong>50% of donation</strong> will be distributed between editors of this region.</li>
      </ul>
	  <p>Please find all rankings and formulas in the reports on OSM Live.</p>
	  <div class="formcontainer">
		<div class="column left">		      
		  <form role="form" action="subscription/register_osm.php" method="post" id="register_osm">
            <h3>Register as a recipient</h3>
            <div class="row list-group-item">
		      <label for="osm_usr">Open Street Map name:</label>				
		      <div class="textbox">
                <input type="text"  id="osm_usr" name="osm_usr"/>				
				<i class="fa fa-user fa-lg"></i>
		      </div>
			  <div class="info">We use OpenStreetMap.org API to access user statistics</div>
		    </div>
				
	     	<div class="row">
              <label for="osm_pwd">Open Street Map password:</label>
			  <div class="textbox">
                <input type="password" id="osm_pwd" name="osm_pwd"/>
				<i class="fa fa-lock fa-lg"></i>
			  </div>
			  <div class="info">We do not store it on our servers</div>
			</div>
			<div class="row">
              <label for="bitcoin_addr">Bitcoin address:</label>
			  <div class="textbox">
                <input type="text" id="bitcoin_addr" name="bitcoin_addr"/>
				<i class="fa fa-credit-card fa-lg"></i>
			  </div>
			  <div class="info">We use OpenStreetMap.org API to access user statistics</div>
			</div>
            <button type="submit" class="btn" id="register_osm_user">Register</button>
          </form>
		</div>
		<div class="column right">
		  <h3>Register as a contributor</h3>
		  <p>If you want to support OSM buy OsmAnd Live Subscription. You can do it directly in the application:</p>
		  <p ><a  href="https://play.google.com/store/apps/details?id=net.osmand.plus">
            <img class="googleplay" alt="Get it on Google Play" src="https://play.google.com/intl/en_us/badges/images/generic/en-play-badge.png"/>
          </a></p>
		  <h4>Donate without any extra changes</h4>
		  <p>If you want to donate without any extra charges and directly to OSM contributors please transfer funds to this Bitcoin address</p>
		  <div class="address">dgfsgdgdsffdhfgjsdfgastrehhgmktyursth</div>
		  <p>The payouts are distributed based on the ranking which is available in OSM Contributions tab, the last ranking has weight = 1, the   ranking before the last has weight = 2 and so on till the 1st ranking.</p>
		</div>
		<div class="clear"></div>
      </div>
    </div>
  <!--  <div id="recipients" class="tab-pane fade ">
      <h4 class="vlabel" for="recipients-info-div">Information</h4 >
        <div class="panel panel-default" id="recipients-info-div">
            <div class="panel-body"><p id="recipients-general-info" class="infobox"></p></div>
        </div>
        <hr>
        <h4 class="vlabel" for="recipient-month-selection">Report period</h4>
            <select class="form-control osm-live-month-select" id="recipient-month-selection">
            </select>
        <h4 class="vlabel" for="recipient-region-selection">Region</h4>
        <select class="form-control" id="recipient-region-selection">
        </select>
        <div class="panel panel-default">
            <div class="panel-body"><p id="recipients-data-info" class="infobox"></p></div>
        </div>
        <hr>
       <h4 class="vlabel" for="recipients-table" id="recipients-table-header">OSM Recipients</h4>
        <table id="recipients-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        </table>
    </div>-->
  </div>
 
  </div>
</div>

<?php include 'blocks/footer.html'; ?>
</div>
</div>

</body>
<script>
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}
var extended = $.urlParam('full') == 'yes';
var mid = "";
var midName = "";
var supportMonth = "";
var supportMonthName = "";
var region = "";
var regionName = "";
var regionsmap = {};
var regionsbydownloadname = {};
var recipientMonth = "";
var recipientMonthName = "";
var recipientRegion = "";
var recipientRegionName = "";




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
  $('#recipient-region-selection').empty();
  regionsmap = {};
  regionsbydownloadname = {};
  if(regionName.length > 0 && regionName != "Worldwide") {
    $("#region-selection").append("<option value='"+region+"'>"+regionName+"</option>"); 
  }
  if(recipientRegionName.length > 0 && recipientRegionName != "Worldwide") {
    $("#recipient-region-selection").append("<option value='"+recipientRegion+"'>"+recipientRegionName+"</option>"); 
  }
  $("#region-selection").append("<option value=''>Worldwide</option>"); 
  $("#recipient-region-selection").append("<option value=''>Worldwide</option>"); 
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
          regionsbydownloadname[row.downloadname] = name;
        }
    }
    var sorted_keys = Object.keys(namemap).sort()
    for(i = 0; i < sorted_keys.length; i++) {
      $("#region-selection").append("<option value='"+namemap[sorted_keys[i]]+"'>"+sorted_keys[i]+"</option>"); 
      $("#recipient-region-selection").append("<option value='"+namemap[sorted_keys[i]]+"'>"+sorted_keys[i]+"</option>"); 
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

function countryName(value) {
  if(value in regionsbydownloadname) {
    return regionsbydownloadname[value];
  }
  return value;
}


var reportRecipientsDataTable;
function updateRecipientsByMonth() {
  if(reportRecipientsDataTable) {
    reportRecipientsDataTable.destroy();
  }
  $.ajax({
        url: "reports/query_report.php?report=recipients_by_month&month="+recipientMonth+"&region="+recipientRegion, 
        async: true
  }).done(function(res) {
        var data = jQuery.parseJSON( res );
        var intro = "";
        var intro2 = "";
         intro += "All payments are done from <strong>1GRgEnKujorJJ9VBa76g8cp3sfoWtQqSs4</strong> Bitcoin address. ";
        intro +="If you want to donate without any extra charges and directly to OSM contributors please transfer funds to this Bitcoin address.<br>";
        intro += "The payouts are distributed based on the ranking which is available in OSM Contributions tab, the last ranking has weight = 1, the ranking before the last has weight = 2 and so on till the 1st ranking.<br>";
        intro2 += "Currently available sum <strong>" + (data.btc * 1000.) +"</strong> mBTC (may vary in the final report). ";
        intro2 += "Currently total weight is <strong> " + data.totalWeight +"</strong>.";
        $("#recipients-general-info").html(intro);
        $("#recipients-data-info").html(intro2);
        reportRecipientsDataTable = $('#recipients-table').DataTable({
            data: data.rows,
            destroy: true,
            columns: [
                { "data": "osmid", title: "OSM ID"},
                { "data": "changes", title: "OSM Changes"},
                { "data": "rank", title: "Rank"},
                { "data": "weight", title: "Weight payout"},
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
        url: "reports/query_report.php?report=supporters_by_month&month="+supportMonth+"&full="+extended, 
        async: true
  }).done(function(res) {
        var data = jQuery.parseJSON( res );
        if(extended) {
          data.rows.push.apply(data.rows, data.notactive)
        }
        $('#donator-report-total').html("There are <strong>" + data.activeCount + 
            "</strong> active donors and <strong>" + data.count +"</strong> registered supporters." );

        reportSupportDataTable = $('#support-table').DataTable({
            data: data.rows,
            destroy: true,
            columns: [
                { "data": "user", "title": "User name"},
                { "data": "status", "title": "Status"},
                { "data": "sku", "title": "Application", "render": skuApp, "visible": extended},
                { "data": "autorenew", "title": "Autorenew", "visible": extended},
                { "data": "region", "title": "Region",  "render": countryName, "visible": extended},
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
            "searching": true
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
  $("#general-info").html("UNDER CONSTRUCTION<br>OsmAnd heavily relies on OSM and its community. Honestly saying, OsmAnd wouldn't exist without that great community. "+
    "When we started implementation OSM Live, we immediately decided that it should not be only a paid service, but a donation service as well. " +
    "Thinking that OSM Live is only possible because thousands of edits every hour in many places of the world, we want to distribute a part of the income between OSM editors. " +
    "<br><br><strong>How it works</strong><ul>" +
    "<li> Every OSM contributor can be registered as a recipient. He just need to provide a valid Bitcoin address in the form below. " +
    "<li> Every OsmAnd user who wants to get live updates needs to subscribe to that service. " +
    "<li> After Google and Bank deductions the whole sum is split into 2 parts (<strong>30% OsmAnd</strong> and <strong>70% Donations</strong>)"+
    "<li> All donations are exchanged into Bitcoin and distributed between OSM contributors according to their ranking."+
    "<li> Every OsmAnd user can select preferred donation region, in that case <strong>50% of donation</strong> will be distributed between editors of this region."+
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

function selectProperTab() {
  var url = document.location.toString();
  if (url.match('#')) {
      $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
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
      $(".osm-live-month-select").prepend("<option value='"+formatYearMonth(yi,mi)+"'>"+formatYearMonthHuman(yi,mi)+"</option>");
    }
  }
  if(typeof(Storage) !== "undefined") {
      if(sessionStorage.supportMonth) {
          supportMonth = sessionStorage.supportMonth;
          supportMonthName = sessionStorage.supportMonthName;
          $("#donate-month-selection").val(supportMonth);
      }
      if(sessionStorage.recipientMonth) {
          recipientMonth = sessionStorage.recipientMonth;
          recipientMonthName = sessionStorage.recipientMonthName;
          $("#recipient-month-selection").val(recipientMonth);
      }
      if(sessionStorage.recipientRegion) {
          recipientRegion = sessionStorage.recipientRegion;
          recipientRegionName = sessionStorage.recipientRegionName;
          $("#recipient-region-selection").val(recipientRegion);
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
  updateRegions();
  updateGeneralInfo();
  updateSupportByMonth();
  updateRecipientsByMonth();
  
  updateTotalChanges();
  updateRankingByMonth();
  updateUserRankingByMonth();
  
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var target = $(e.target).attr("href") // activated tab
      window.location.hash = target;
  });
  window.onpopstate = function(event) {
    selectProperTab();
  };
  selectProperTab();

  $('#donate-month-selection').on('change', function (e) {
      var optionSelected = $("option:selected", this);
      supportMonth = this.value;
      supportMonthName = optionSelected.text();
      if(typeof(Storage) !== "undefined") {
        sessionStorage.supportMonth = supportMonth;
        sessionStorage.supportMonthName = supportMonthName;
      }
      updateSupportByMonth();
  });
  $('#recipient-month-selection').on('change', function (e) {
      var optionSelected = $("option:selected", this);
      recipientMonth = this.value;
      recipientMonthName = optionSelected.text();
      if(typeof(Storage) !== "undefined") {
        sessionStorage.recipientMonth = recipientMonth;
        sessionStorage.recipientMonthName = recipientMonthName;
      }
      updateSupportByMonth();
  });
  $('#recipient-region-selection').on('change', function (e) {
      var optionSelected = $("option:selected", this);
      recipientRegion = this.value;
      recipientRegionName = optionSelected.text();
      if(typeof(Storage) !== "undefined") {
        sessionStorage.recipientRegion = recipientRegion;
        sessionStorage.recipientRegionName = recipientRegionName;
      }
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

</script>

</html>