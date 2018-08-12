<div id="planlist" style="width:1000px">
    <ul style="width:1000px">
       <li plid="listId1"><a href="#pl-1">List 1</a></li>
       <li plid="listId2"><a href="#pl-2">List 1</a></li>
       <li plid="listId3"><a href="#pl-3">List 1</a></li>
       <li plid="listId4"><a href="#pl-4">List 1</a></li>
    </ul>
    <div id="pl-1"></div>
    <div id="pl-2"></div>
    <div id="pl-3"></div>
    <div id="pl-4"></div>
</div>
<script type="text/javascript" language="javascript">
    $(function () {
        var tabs = $("#planlist").tabs();
        tabs.find(".ui-tabs-nav").sortable({
            axis: "x",
            stop: function () {
                tabs.tabs("refresh");
            },
            update: function (event, ui) {
                //db id of the item sorted
                alert(ui.item.attr('plid'));
                //db id of the item next to which the dragged item was dropped
                alert(ui.item.prev().attr('plid'));

                //make ajax call
            }
        });
    });
</script>
