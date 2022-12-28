Documentation about motd_config.json
================================
# Condition properties
**IP** - desired IP Address of client that should receive the message.
```
"ip" : "37.57.120.65"
```


**OS** - defines platform, should be "ios" or "android".   
```
"os": "android"
```


**Date range** - consists of two properties: 'start_date' and 'end_date'. Defines start and end date of the sale.
```
"start_date": "11-10-2018 00:00"
"end_date": "16-10-2018 00:00"
```
Important: Date fields will be propagated to the file itself and override start/end dates in the file.

**OsmAnd Version** - corresponds to 'version' property. Contains version of application. For example, Travel links will be work only from version 3.
```
"version": "3"
```

**Country** - corresponds to 'country' property. Filters by specified country, country is detected from IP.
```
"country" : "Netherlands"
```

**City** - corresponds to 'city' property. Filters by specified city, city is detected from IP.
```
"city" : "Minsk"
```

**Language** - corresponds to 'lang' property. Contains selected in application or provided by platform two-letter codes of language. https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
```
"lang" : "uk"
or
"lang" : "ru, de, en"
```


**File** - contains the json file's name which contains base [motd json properties](#motd-json-properties-android--ios).
```
"file": "discount.json"
```


**Fields** - contains the key-value list of properties. The main purpose of this property is to modify properties in the motd message based on the file designated by 'file' property without altering the 'file'. Each key in the list should match with the property name from [motd json properties](#motd-json-properties-android--ios). In the example below the properties 'message' and 'description' in the file designated by the 'file' property will be substituted by values from the 'fields' property. 
  ``"fields": {
				"message": "Get OsmAnd Unlimited -50%",
				"description": "Cozy autumn sale!"
			}``

### True condition
The true condition is condition which has all true properties. True property is property which is equal to request parameter or starts with/contains request parameter or in case of date range the request parameter satisfies the expression: start_date > date from request < end_date.

All 'conditions' are processed in order from beginning to the end of file to the first true conditon.

### Message modifying
After true condition is found, the 'fields' property is tested for presence of any key-value pairs. If 'fields' property is not empty then properties from 'fields' property is used for modifying original message designated by 'file' property otherwise the original message is returned without modification.




# Motd json properties (Android / iOS)
```
"message" : "Some title"
```
**message** - notification title.

```
"description" : "Some description"
```
**description** - notification description.

- **start** - start of the period in which the notification will be active.
  - "start" : "10-06-2018 00:00"
- **end** - end of the period in which the notification will be active.
  - "end" : "30-06-2018 23:59"
- **show_start_frequency** - the notification will be shown after *X* application starts ignoring **show_day_frequency** but it won't exceed **max_total_show**. 
  - "show_start_frequency" : 3 - once per three app starts
- **show_day_frequency** - the number is double,  the notification will be shown after *X* days starts ignoring **show_start_frequency** but it won't exceed **max_total_show**. 
  - "show_day_frequency" : 2 - once per two days
  - "show_day_frequency" : 0.5 - 2 times a day
- **max_total_show** - total amount of displays of this specific notification.
  - "max_total_show" : 10
- **icon** - id of the icon for the notification.
  - "icon" : "ic_action_travel"
- **icon_color** - color (6 digit hex code) for the 'icon'. Optional parameter.
  - "icon_color" : "#ffffff"
- **bg_color** - color (6 digit hex code) for the notification background. Optional parameter.
  - "bg_color" : "#fec601"
- **title_color** - color (6 digit hex code) for the 'message' text. Optional parameter.
  - "title_color" : "#000000"
- **description_color** - color (6 digit hex code) for the 'description' text. Optional parameter.
  - "description_color" : "#000000"
- **status_bar_color** - color (6 digit hex code) for the status bar. Optional parameter.
  - "status_bar_color" : "#fec601"
- **url** - url, that will be opened on notification click.
  - "url" : "https://osmand.net/travel?title=World_Cup_2018&lang=en" - to open travel article
- **url_params** - - JSON object that specifies additional url params. 
 -   "url_params" : { "selected_choose_plan_btn" : "osmand_pro_monthly_free" } - specify selected purchase button opened via url in OsmAnd Pro and OsmAnd Maps+ screens. Use purchase sku or "annual", "monthly" for value.
  - **ANDROID**
  	- "url" : "osmand-market-app:net.osmand.plus" - to open available market with specified app
   	- "url" : "osmand-in-app:osmand_full_version_price" - to purchase full version (starts purchasing immediately)
   	- "url" : "osmand-in-app:osm_live_subscription_2,osm_free_live_subscription_2" - to open choose plan screen
   	- "url" : "osmand-search-query:test query" - to open search with "test query" phrase
   	- "url" : "osmand-show-poi:bank,tourism" - to show poi overlay on the map
	- "url" : "open_activity" - to open activity specified in the "activity" JSON object
   	- "url" : "show-choose-plan:free-version" - to show choose plan (Free version type)
   	- "url" : "show-choose-plan:sea-depth" - to show choose plan (Sea depth type)
   	- "url" : "show-choose-plan:hillshade" - to show choose plan (Hillshade type)
   	- "url" : "show-choose-plan:wikipedia" - to show choose plan (Wikipedia type)
   	- "url" : "show-choose-plan:wikivoyage" - to show choose plan (Wikivoyage type)
   	- "url" : "show-choose-plan:osmand-cloud" - to show choose plan (OsmAnd Cloud type)
   	- "url" : "show-choose-plan:advanced-widgets" - to show choose plan (Advanced widgets type)
   	- "url" : "show-choose-plan:hourly-map-updates" - to show choose plan (Hourly map updates type)
   	- "url" : "show-choose-plan:monthly-map-updates" - to show choose plan (Monthly map updates type)
   	- "url" : "show-choose-plan:unlimited-map-downloads" - to show choose plan (Unlimited map downloads type)
   	- "url" : "show-choose-plan:combined-wiki" - to show choose plan (Combined wiki type)
   	- "url" : "show-choose-plan:osmand-pro" - to show choose plan (OsmAnd Pro type)
   	- "url" : "show-choose-plan:osmand-maps-plus" - to show choose plan (OsmAnd Maps+ type)	
   	- "url" : "show-choose-plan:external-sensors-support" - to show choose plan (External sensors support type)
  - **iOS**
  	- "url" : "in-app:plugin" - to open available plugin of in-app defined in "in-app:" field
  	- "url" : "in-app:map" - to open Maps & Resources screen
	- "url" : "osmand-search-query:test query" - to open search with "test query" phrase
   	- "url" : "osmand-show-poi:bank,tourism" - to show poi overlay on the map
   	- "url" : "show-choose-plan:free-version" - to show choose plan (Free version type)
   	- "url" : "show-choose-plan:sea-depth" - to show choose plan (Sea depth type)
   	- "url" : "show-choose-plan:hillshade" - to show choose plan (Hillshade type)
   	- "url" : "show-choose-plan:wikipedia" - to show choose plan (Wikipedia type)
   	- "url" : "show-choose-plan:wikivoyage" - to show choose plan (Wikivoyage type)
   	- "url" : "show-choose-plan:osmand-cloud" - to show choose plan (OsmAnd Cloud type)
   	- "url" : "show-choose-plan:advanced-widgets" - to show choose plan (Advanced widgets type)
   	- "url" : "show-choose-plan:hourly-map-updates" - to show choose plan (Hourly map updates type)
   	- "url" : "show-choose-plan:monthly-map-updates" - to show choose plan (Monthly map updates type)
   	- "url" : "show-choose-plan:unlimited-map-downloads" - to show choose plan (Unlimited map downloads type)
   	- "url" : "show-choose-plan:combined-wiki" - to show choose plan (Combined wiki type)
   	- "url" : "show-choose-plan:osmand-pro" - to show choose plan (OsmAnd Pro type)
   	- "url" : "show-choose-plan:carplay" - to show choose plan (Carplay type)
   	- "url" : "show-choose-plan:weather" - to show choose plan (Weather type)
   	- "url" : "show-choose-plan:osmand-maps-plus" - to show choose plan (OsmAnd Maps+ type)	
- **application** - JSON object that specifies which applications must show notification.
  -   "application" : { "net.osmand" : true, "net.osmand.plus" : false } - notification will be shown only in the free app
- **show_christmas_dialog** - specify if the Christmas dialog should be displayed instead of notification. Optional parameter.
  - "show_christmas_dialog" : true
- **button_title** - button title.
  - "button_title" : "Some title"
- **button_title_color** - color (6 digit hex code) for the 'button_title' text. Optional parameter.
  - "button_title_color" : "#fec601"
- **activity** - JSON object that specifies which activity will be shown.
  - "activity" : { "activity_name" : "net.osmand.plus.myplaces.FavoritesActivity", "SOME_BOOLEAN_EXTRA" : true } - Favorites activity will be shown. Specified extras will be passed to intent.
- **oneOfConditions** - JSON array that specifies number of conditions to check if notification will be shown.
  - "oneOfConditions" : [
  - { "condition" : [ { "not_purchased_subscription" : "sku1" }, { "purchased_subscription" : "sku2" } ] },
  - { "condition" : [ { "not_purchased_inapp" : "sku3" }, { "not_purchased_inapp" : "sku4" } ] },
  - { "condition" : [ { "not_purchased_plugin" : "nauticalPlugin.plugin" }, { "purchased_plugin" : "osmand.srtm" } ] }
  - ]  
	Checks if (subscription sku1 is not purchased AND sku2 is purchased) OR (inapp sku3 is not purchased AND inapp sku4 is also not purchased) OR (plugin nauticalPlugin.plugin is not purchased AND plugin osmand.srtm is purchased))
	So array of oneOfConditions is combined with OR and array of "condition" with AND.
	- Possible conditions: 
	- type: "**not_purchased_subscription**" or "**purchased_subscription**", value: **SKU** of subscription
	- type: "**not_purchased_inapp**" or "**purchased_inapp**", value: **SKU** of inapp
	- type: "**not_purchased_plugin**" or "**purchased_plugin**", value: "**nauticalPlugin.plugin**" or "**osmand.parking.position**" or "**skimaps.plugin**" or "**osmand.srtm**"
	
  
# Procedure to deploy changes
