var Timeline = function () {

    var apiUrl = "/posts",
        dataSet = [],
        columns = [
            { title: "Date" },
            { title: "Source" },
            { title: "Summary" },
            { title: "" }
        ],
        $timelineTable;

    var fetch = function () {
        $.get(apiUrl, function(data) {
            buildDataSet(data.data);
            $timelineTable.DataTable({
                data: dataSet,
                columns: columns,
                pageLength: 6,
                lengthChange: false,
                order: [[0, "desc"]],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: ""
                }
            });
        });
    };

    var buildDataSet = function (results) {
        for (var i = 0; i < results.length; i++) {
            var post = results[i];
            dataSet.push([
                buildDateHtml(post.createdAt),
                buildSourceHtml(post.source),
                post.summary,
                post.action
            ]);
        }
    };

    var buildDateHtml = function (createdAt) {
        return "<time datetime='" + createdAt + "'>" + moment(createdAt).format("YYYY/MM/DD") + "</time>";
    };

    var buildSourceHtml = function (source) {
        return "<i class='fa fa-2x fa-" + source.toLowerCase() + "'><span>" + source + "</span></i>";
    };

    return {
        init: function () {
            $timelineTable = $("#timeline-table");
            fetch();
        }
    }
}();

$(document).ready(function() {
    Timeline.init();
});
