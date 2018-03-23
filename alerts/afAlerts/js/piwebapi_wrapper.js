/***************************************************************************
   Copyright 2015 OSIsoft, LLC.
   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at
       http://www.apache.org/licenses/LICENSE-2.0
   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 ***************************************************************************/

var afServerName = "EELTPIAF";
var afDatabaseName = "Ethos";
var efTemplateName = "StreetView_EFTemplate";

var piwebapi = (function () {
    // private variables
    var basePIWebAPIUrl = null;
    var currentUserName = null;
    var currentPassword = null;
    var currentEFName = null; 
    var currentEFWebId = null;
    var currentAttributesWebId = null;
    var currentAFDatabaseWebID = null;

    // private methods
    var processJsonContent = function (url, type, data, successCallBack, errorCallBack) {
        return $.ajax({
            url: encodeURI(url),
            type: type,
            data: data,
            contentType: "application/json; charset=UTF-8",
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", makeBasicAuth(currentUserName, currentPassword));
            },
            success: successCallBack,
            error: errorCallBack
        });
    };

    var makeBasicAuth = function (user, password) {
        var tok = user + ':' + password;
        var hash = window.btoa(tok);
        return "Basic " + hash;
    };

    var getDatabaseNameList = function(successCallback, errorCallBack) {
        var url = basePIWebAPIUrl + "assetservers";
        console.log(url);
        var serverData = processJsonContent(url, 'GET', null, successCallback, errorCallBack);

        $.when(serverData).fail(function () {
            console.log("Cannot connect to AF server ");
            return "fail";
        });

        $.when(serverData).done(function (data){
            console.log("server found"); 
            console.log(data.Items[0].WebId);
            //console.log(data.Items[0].WebId);
            currentAFDatabaseWebID = data.Items[0].WebId;
            return data.Items[0].WebId;
            
        })
        
    };

    var getDatabaseWebId = function (databaseName, successCallBack, errorCallBack) {
        var url = basePIWebAPIUrl + "assetdatabases?path=\\\\" + afServerName + "\\" + databaseName;
        return processJsonContent(url, 'GET', null, successCallBack, errorCallBack);
    };

    var getEventFrameWebId = function (databaseName, eventFrameName, successCallBack, errorCallBack) {
        var url = basePIWebAPIUrl + "eventframes?path=\\\\" + afServerName + "\\" + databaseName
             + "\\EventFrames[" + eventFrameName + "]";
        return processJsonContent(url, 'GET', null, successCallBack, errorCallBack);
    };

    var getAttributesWebId = function (eventframeWebId, successCallBack, errorCallBack) {
        var url = basePIWebAPIUrl + "eventframes/" + eventframeWebId + "/attributes";
        return processJsonContent(url, 'GET', null, successCallBack, errorCallBack);
    };

    var sendValuesToPI = function (panorama) {
        var data = [];
        for (var key in attributesWebId) {
            var obj = {};
            obj.WebId = attributesWebId[key];
            obj.Items = [];

            var newValue = {};
            newValue.Timestamp = "*";
            if (key == "Latitude") {
                newValue.Value = panorama.position.lat();
            }
            else if (key == "Longitude") {
                newValue.Value = panorama.position.lng();
            }
            else if (key == "Heading") {
                newValue.Value = panorama.pov.heading;
            }
            else if (key == "Pitch") {
                newValue.Value = panorama.pov.pitch;
            }
            else if (key == "Zoom") {
                newValue.Value = panorama.pov.zoom;
            }
            obj.Items.push(newValue);
            data.push(obj);
        }
        var postData = JSON.stringify(data);
        var url = basePIWebAPIUrl + "streamsets/" + currentEFWebId + "/recorded";
        var ajax = processJsonContent(url, 'POST', postData, null, null);
        $.when(ajax).fail(function () {
            console.log("Cannot write data to AF attributes.");
        });
        $.when(ajax).done(function () {

        });
    }

    return {
        // Set base PI Web API URL
        SetBaseUrl: function (baseUrl) {
            basePIWebAPIUrl = baseUrl;
            if (basePIWebAPIUrl.slice(-1) != '/') {
                basePIWebAPIUrl = basePIWebAPIUrl + "/";
            }
        },

        // Set username and password
        SetCredentials: function (user, password) {
            currentUserName = user;
            currentPassword = password;
        },

        // Check authentication
        Authorize: function (successCallBack, errorCallBack) {
            // Make ajax call
            return processJsonContent(basePIWebAPIUrl, 'GET', null, successCallBack, errorCallBack);
        },

        Reset: function() {
            basePIWebAPIUrl = null;
            currentUserName = null;
            currentPassword = null;
            currentEFName = null;
            currentEFWebId = null;
            currentAttributesWebId = null;
        },

        CreateEventFrame: function () {
            // Get WebId for af database
            var ajaxDb = getDatabaseWebId(afDatabaseName, null, null);

            $.when(ajaxDb).fail(function () {
                console.log("Cannot connect to AF database " + afDatabaseName);
            });

            $.when(ajaxDb).done(function (data){
                console.log(data);
                console.log("database found");
            })
            
            var ajaxAFServer = getDatabaseNameList(null, null);

            console.log(currentAFDatabaseWebID);
           /* $.when(ajaxAFServer).fail(function () {
                console.log("Cannot connect to AF server ");
            });

            $.when(ajaxAFServer).done(function (data){
                console.log("server found"); 
                console.log(data);
                //console.log(data.Items[0].WebId);
                
            })

            // Create event frame
            $.when(ajaxDb).done(function (data) {
                var url = basePIWebAPIUrl + "assetdatabases/" + data.WebId + "/eventframes";
                var now = JSON.stringify(new Date());
                currentEFName = currentUserName + "_" + now.slice(1, now.length - 1);
                var data = {
                    "Name" : currentEFName,
                    "Description" : "Event frame from user " + currentUserName,
                    "TemplateName" : efTemplateName,
                    "StartTime" : "*",
                    "EndTime": "*+5m"
                };
                var postData = JSON.stringify(data);
                var ajaxEF = processJsonContent(url, 'POST', postData, null, null);

                $.when(ajaxEF).fail(function () {
                    console.log("Cannot create event frame.");
                });

                $.when(ajaxEF).done(function () {
                    console.log("Event frame created successfully.");
                    alert("You may now start recording.");
                });
            });*/
        },

        CloseEventFrame: function () {
            // Get WebId for event frame
            var ajaxEF = getEventFrameWebId(afDatabaseName, currentEFName, null, null);

            $.when(ajaxEF).fail(function () {
                console.log("Cannot find event frame " + currentEFName);
            });

            // Update event frame to put new end time
            $.when(ajaxEF).done(function (data) {
                var url = basePIWebAPIUrl + "eventframes/" + data.WebId;
                var data = {
                    "EndTime" : "*"
                };
                var patchData = JSON.stringify(data);
                var ajaxEF2 = processJsonContent(url, 'PATCH', patchData, null, null);

                $.when(ajaxEF2).fail(function () {
                    console.log("Cannot close event frame.");
                });

                $.when(ajaxEF2).done(function () {
                    console.log("Event frame closed successfully.");
                    alert("The recording has ended.");
                });
            });
        },

        SendValues: function (panorama) {
            if (currentEFWebId == null || currentAttributesWebId == null) {
                // Get WebId of event frame
                var ajaxEF = getEventFrameWebId(afDatabaseName, currentEFName, null, null);
                $.when(ajaxEF).fail(function () {
                    consoloe.log("Cannot find event frame " + currentEFName);
                });

                // Get WebId of attributes
                $.when(ajaxEF).done(function (data) {
                    currentEFWebId = data.WebId;
                    var ajaxAttr = getAttributesWebId(currentEFWebId, null, null);
                    $.when(ajaxAttr).fail(function () {
                        console.log("Cannot find attributes from event frame.");
                    });
                    $.when(ajaxAttr).done(function (data) {
                        // Get attributes Web Id
                        attributesWebId = {};
                        for (i = 0; i < data.Items.length; i++) {
                            attributesWebId[data.Items[i].Name] = data.Items[i].WebId;
                        }
                        // Send values to attributes
                        sendValuesToPI(panorama);
                    });
                });
                // Send Values to attributes
            }
            else {
                sendValuesToPI(panorama);
            }
                
            
        }
    }
    
})();