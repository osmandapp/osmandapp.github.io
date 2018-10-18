Documentation about motd_config.json
================================
# Conditions properties
### IP  
  Desired IP Address of client that should receive the message
### OS  
  Defines platform, should be "ios" or "android".
### Date range  
  Consists of two properties: 'start_data' and 'end_date'. Defines start and end date of the sale.
### OsmAnd Version
  Corresponds to 'version' property. Contains version of application.
### Langauge
  Corresponds to 'lang' property. Contains selected application or default platform language.  

### True condition. 
The true condition is condition which has all true properties. True property is property which is equal to request parameter or starts with/contains request parameter or in case of date range the request parameter satisfies the expression: start_date > date from request < end_date.

All 'condition' are processed in order from top to bottom to the first true conditon.

# Example with test ip



# Motd json properties (Android / IOs)


# Procedure to deploy changes
