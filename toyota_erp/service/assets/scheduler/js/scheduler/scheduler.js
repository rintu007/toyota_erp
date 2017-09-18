(function (window) {
    window.Scheduler = function (config) {
        var parent = this;
        var idArray = this.idArray = [];
        var appointments = this.appointments = {};
        var defaults = {
            fields: ["Bay 1", "Bay 2", "Bay 3", "Bay 4", "Bay 5"],
            beforeFields: ["Waiting"],
            afterFields: ["RoadTest", "Wash"],
            timeSpan: 1,
            headerSpan: 30,
            headSpan: 30,
            totalTime: 8,
            timeUnit: 60,
            startTime: "08:00",
            endTime: "18:00",
            table: "#table",
            dataURL: "http://192.168.1.195/service/index.php/jpcb/AllAppointments",
            formURL: "http://192.168.1.195/service/index.php/jpcb/form",
            RoadWashURL: "http://192.168.1.195/service/index.php/jpcb/roadwash",
            WashCompleteURL: "http://192.168.1.195/service/index.php/jpcb/washcomplete"
        };
        config = config || defaults;

//===============Private Functions & Classes ============================

        function Fields(prop) {
            this.key = prop;
            this.add = function (data, field) {
                console.log(data);
                console.log("Prop : ", this.key);
                var key = field.replace(" ", "_");
                var startTime = data["startTime"].replace(":", "_");
                var endTime = data["endTime"].replace(":", "_");
                var extendTime = data["extendedTime"].replace(":", "_");
                var addtionalTime = data["addtionalTime"] ? data["addtionalTime"].replace(":", "_") : "00_00";

                var sfillTimeObj = startTime.split("_");
                var sfillMinutes = parseInt(sfillTimeObj.pop());
                var sfillHours = parseInt(sfillTimeObj.pop());

                var efillTimeObj = endTime.split("_");
                var efillMinutes = parseInt(efillTimeObj.pop());
                var efillHours = parseInt(efillTimeObj.pop());

                var exfillTimeObj = extendTime.split("_");
                var exfillMinutes = parseInt(exfillTimeObj.pop());
                var exfillHours = parseInt(exfillTimeObj.pop());

                var adfillTimeObj = addtionalTime.split("_");
                var adfillMinutes = parseInt(adfillTimeObj.pop());
                var adfillHours = parseInt(adfillTimeObj.pop());


                //formulation of hours in minutes & looping through it
                var st = (sfillHours * config["timeUnit"]) + sfillMinutes;
                var et = (efillHours * config["timeUnit"]) + efillMinutes;
                var ex = (exfillHours * config["timeUnit"]) + exfillMinutes;
                var ad = (adfillHours * config["timeUnit"]) + adfillMinutes;
                sfillMinutes = sfillMinutes + 1;
                $("#" + key + "_" + pad(sfillHours) + "_" + pad(sfillMinutes))
                        .addClass("filled")
                        .attr("colspan", et - st)
                        .attr("iddata", data.idAppointment)
                        .append(data.Name)
                        .click(function (e) {
                            getFormData(this);
                        });
                sfillMinutes = sfillMinutes + 1;
                if (ex > 0) {
                    efillMinutes = efillMinutes + 1;
                    $("#" + key + "_" + pad(efillHours) + "_" + pad(efillMinutes))
                            .addClass("filled extend")
                            .attr("colspan", ex);
                    efillMinutes = efillMinutes + 1;
                    for (var i = 0; i < (ex - 1); i++) {
                        if (efillMinutes === 59) {
                            $("#" + key + "_" + pad(efillHours++) + "_" + pad(efillMinutes)).addClass("filled hidecel");
                            efillMinutes = 0;
                        } else
                        {
                            $("#" + key + "_" + pad(efillHours) + "_" + pad(efillMinutes++)).addClass("filled hidecel");
                        }
                    }
                }
                if (ad > 0) {
                    console.log("if called");
                    efillMinutes = efillMinutes + 1;
                    $("#" + key + "_" + pad(efillHours) + "_" + pad(efillMinutes))
                            .addClass("filled addtional")
                            .attr("colspan", ad);
                    efillMinutes = efillMinutes + 1;
                    for (var i = 0; i < (ad - 1); i++) {
                        if (efillMinutes === 59) {
                            $("#" + key + "_" + pad(efillHours++) + "_" + pad(efillMinutes)).addClass("filled hidecel");
                            efillMinutes = 0;
                        } else
                        {
                            $("#" + key + "_" + pad(efillHours) + "_" + pad(efillMinutes++)).addClass("filled hidecel");
                        }
                    }
                }
                for (var i = 0; i < ((et - st) - 1); i++) {
                    if (sfillMinutes === 59) {
                        $("#" + key + "_" + pad(sfillHours++) + "_" + pad(sfillMinutes)).addClass("filled hidecel");
                        sfillMinutes = 0;
                    } else
                    {
                        $("#" + key + "_" + pad(sfillHours) + "_" + pad(sfillMinutes++)).addClass("filled hidecel");
                    }
                }
//              Adding to window context
                window.appointments = appointments;
                appointments[key][data.id] = data;

            };

            this.update = function () {
                console.log(prop);
            };

            this.remove = function () {
                console.log(prop);
            };
        }

        function beforeFields(prop) {
            this.key = prop;
            this.$obj = $("#" + this.key);
            this.add = function (data) {
                var $span = $("<span></span>");
                $span.addClass("waiting-box")
                        .append(data["Name"])
                        .click(function (e) {
                            console.log(prop, " : Clicked");
                        });
                this.$obj.append($span);
            };

            this.update = function () {
                console.log(prop);
            };

            this.remove = function () {
                console.log(prop);
            };
        }

        function afterFields(prop) {
            this.key = prop;
            this.$obj = $("#" + this.key);
            console.log(this.$obj);
            this.add = function (data) {
                var $span = $("<span></span>");
                $span.addClass("waiting-box")
                        .append(data["Name"])
                        .click(function (e) {
                            if (prop == "Wash") {
                                getWashComplete(data["idAppointment"]);
                                console.log(prop, data["idAppointment"]);
                            } else {
                                console.log(prop, data["idAppointment"]);
                                getRoadWash(data["idAppointment"]);
                            }
                        });
                this.$obj.append($span);
            };

            this.update = function () {
                console.log(prop);
            };

            this.remove = function () {
                console.log(prop);
            };
        }

        function init(config) {
            var table = config["table"];
            //getting the total number of boxes
            parent.boxes = (config["totalTime"] * config["timeUnit"]) / config["timeSpan"];
            //Getting time to for the exis
            var timeObj = config["startTime"].split(":");
            parent.time = config["startTime"];
            parent.hours = parseInt(timeObj[0]);
            parent.minutes = parseInt(timeObj[1]);
            table = $(table);
            renderHeader(table);
            generateIds();
            render(table);
            //getting data from server
            getData(function (data) {
                populate(data);
            });
            //Temporary Initializing properties
            for (var key in config["fields"]) {
                if (config["fields"].hasOwnProperty(key)) {
                    parent[config["fields"][key]] = new Fields(config["fields"][key]);
                    var field = config["fields"][key].replace(" ", "_");
                    parent.appointments[field] = new Object();
                }
            }
            for (var i = 0; i < config["beforeFields"].length; i++) {
                if (config["beforeFields"].hasOwnProperty(i)) {
                    parent[config["beforeFields"][i]] = new beforeFields(config["beforeFields"][i]);
                    var beforeField = config["beforeFields"][i].replace(" ", "_");
                    parent.appointments[beforeField] = new Object();
                }
            }
            for (var i = 0; i < config["afterFields"].length; i++) {
                if (config["afterFields"].hasOwnProperty(i)) {
                    parent[config["afterFields"][i]] = new afterFields(config["afterFields"][i]);
                    var afterField = config["afterFields"][i].replace(" ", "_");
                    parent.appointments[afterField] = new Object();
                }
            }
        }

        function render(table) {
            var row = "<tr></tr>";
            var column = "<td></td>";
            var $tbody = table.find("tbody");
            var $row, $column;
            //Before fields rows can be multiple with colspan
            for (var i = 0; i < config["beforeFields"].length; i++) {
                $row = $(row);
                $column = $(column);
                $column.attr("colspan", parent.boxes);
                $column.attr("id", config["beforeFields"][i]);
                $row.append($column);
                $row.prepend($("<th></th>").addClass("firstHead").append(config["beforeFields"][i]));
                $tbody.append($row);
            }

            //Main fields rendering on left side
            for (var i = 0; i < config["fields"].length; i++) {
                $row = $(row);
                for (var j = 0; j < parent.boxes; j++) {
                    $column = $(column);
                    $column.attr("id", config["fields"][i].replace(" ", "_") + "_" + idArray[j])
                            .addClass("box");
                    $row.append($column);
                }
                $row.prepend($("<th></th>").addClass("firstHead").append(config["fields"][i]));
                $tbody.append($row);
            }

            //After fields rows can be multiple with colspan
            for (var i = 0; i < config["afterFields"].length; i++) {
                $row = $(row);
                $column = $(column);
                $column.attr("colspan", parent.boxes);
                $column.attr("id", config["afterFields"][i]);
                $row.append($column);
                $row.prepend($("<th></th>").addClass("firstHead").append(config["afterFields"][i]));
                $tbody.append($row);
            }

        }

        function renderHeader(table) {
            var row = "<tr></tr>";
            var thead = table.find("thead");
            row = $(row);
            var time = parent.time;
            var hours = parent.hours;
            var minutes = parent.minutes;
            for (var i = 0; i < (parent.boxes / config["headerSpan"]); i++) {
                var column = "<th colspan='" + config["headerSpan"] + "'></th>";
                column = $(column);
                column.append(time);

                minutes += config["headerSpan"];
                if (minutes % config["timeUnit"]) {
                    time = pad(hours) + ":" + pad(minutes);
                }
                else
                {
                    minutes = 00;
                    hours += 01;
                    time = pad(hours) + ":" + pad(minutes);
                }
                row.append(column);
            }
            //adding first column for heading and infor
            row.prepend($("<th>Description</th>").addClass("firstHead"));
            thead.append(row);
        }

        function generateIds() {
            var time = parent.time;
            var hours = parent.hours;
            var minutes = parent.minutes;
            for (var i = 0; i < parent.boxes; i++) {
                minutes += config["timeSpan"];
                if (minutes % config["timeUnit"]) {
                    time = pad(hours) + ":" + pad(minutes);
                }
                else
                {
                    minutes = 00;
                    hours += 01;
                    time = pad(hours) + ":" + pad(minutes);
                }
                var id = time.replace(":", "_");
                idArray.push(id);
            }
        }

        function populate(data) {
            data = JSON.parse(data);
            for (var key in data) {
                for (var i = 0; i < data[key].length; i++) {
                    parent[key].add(data[key][i], key);
                }
            }
        }

        function getData(callback) {
            $.get(config["dataURL"], function (data) {
                parent.data = data;
                callback(data);
//                console.log(data);
            });
        }
//=================Util functions =========================================
        function pad(d) {
            return (d < 10) ? '0' + d.toString() : d.toString();
        }

        function extendTime(idAppointment) {

        }

        function getFormData(idAppointment) {
            $.get(config["formURL"] + "/" + $(idAppointment).attr("iddata"), function (res) {
                bootbox.dialog({
                    message: res,
                    title: "Information"
                });
            });
        }

        function getRoadWash(idAppointment) {
            $.get(config["RoadWashURL"] + "/" + idAppointment, function (res) {
                bootbox.dialog({
                    message: res,
                    title: "Information"
                });
            });
        }

        function getWashComplete(idAppointment) {
            $.get(config["WashCompleteURL"] + "/" + idAppointment, function (res) {
                bootbox.dialog({
                    message: res,
                    title: "Information"
                });
            });
        }

        init(config);
    };
})(window);