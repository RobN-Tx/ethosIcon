var piwebapi = (function () {
    var base_service_url = "NotDefined";

    var username = 'ethosvision\ethosvisionadmin';

    var password = '3ThosRMD';

    function GetJsonContent(url, successCallBack, errorCallBack) {
       //console.log(url);
        $.ajax({
            type: 'GET',
            headers: { 
                "Content-Type": "application/json; charset=utf-8", 
            }, 
            url: url, 
            cache: false, 
            //data: data, 
            async: true, 
            username: username, 
            password: password, 
            crossDomain: true, 
            xhrFields: { 
                withCredentials: true 
            }, 
            success: successCallBack, 
            error: errorCallBack 

        });
        //console.log("done");
       
    }

    function CheckPIServerName(piServerName, UpdateDOM) {
        BaseUrlCheck();
        var url = base_service_url + "dataservers?name=" + piServerName;
        GetJsonContent(url, (function (piServerJsonData) {
            //console.log(true);
        }), (function () {
            //console.log(false);
        }));
    }


    function CheckPIPointName(piServerName, piPointName, UpdateDOM) {

        BaseUrlCheck();
        url = base_service_url + "points?path=\\\\" + piServerName + "\\" + piPointName;
        GetJsonContent(url, (function (piPointJsonData) {
            piPointLinksJsonData = piPointJsonData;
            UpdateDOM(true);
        }), (function () {
            UpdateDOM(false)
        }));
    }



    function GetData(piServerName, piPointName, ServiceUrl, QueryString, UpdateDOM) {
        //console.log("getting data");
        BaseUrlCheck();
        url = base_service_url + "points?path=\\\\" + piServerName + "\\" + piPointName;
        //console.log(url);
        //console.log("hi" + QueryString);
        GetJsonContent(url, (function (piPointJsonData) {
            //console.log("hi" +QueryString);
            var url_data1 = piPointJsonData["Links"];
            var url_data = url_data1[ServiceUrl] + QueryString;

            //console.log(url_data);
            GetJsonContent(url_data, (function (JsonData) {
                var additionalReturnData = { "currentTag" : piPointName};
                JsonData["currentTag"] = piPointName;
                //console.log(JsonData);
                UpdateDOM(JsonData);
            }), (function () {
                UpdateDOM("Error: Parameters are incorrect.");
            }));
        }), (function () {
            UpdateDOM("Error: Could not find PI Point on the selectedsdfsdf PI Data Archive.");
        }));
    }

    function BaseUrlCheck() {
        if (base_service_url == "NotDefined") {
            alert("Service base url was not defined");
        }
    }

    return {
        ValidPIServerName: function (piServerName, UpdateDOM) {
            CheckPIServerName(piServerName, UpdateDOM)
        },

        ValidPIPointName: function (piServerName, piPointName, UpdateDOM) {
            CheckPIPointName(piServerName, piPointName, UpdateDOM);
        },

        GetSnapshotValue: function (piServerName, piPointName, UpdateDOM) {
           //console.log("getsnapshot");
            GetData(piServerName, piPointName, "Value", "", UpdateDOM);
        },
        GetRecordedValues: function (piServerName, piPointName, startTime, endTime, UpdateDOM) {
            GetData(piServerName, piPointName, "RecordedData", "?starttime=" + startTime + "&endtime=" + endTime, UpdateDOM);
        },
        GetInterpolatedValues: function (piServerName, piPointName, startTime, endTime, interval, UpdateDOM) {
            GetData(piServerName, piPointName, "InterpolatedData", "?starttime=" + startTime + "&endtime=" + endTime + "&interval=" + interval, UpdateDOM);
        },
        SetBaseServiceUrl: function (baseUrl) {
            base_service_url = baseUrl;
            if (base_service_url.slice(-1) != "/") {
                base_service_url = base_service_url + "/";
            }
        }
    }
}());
