// <script type="text/javascript">

    function checkByParent(aId, aChecked) {
        var collection = document.getElementById(aId).getElementsByTagName('INPUT');
        for (var x=0; x<collection.length; x++) {
            if (collection[x].type.toUpperCase()=='CHECKBOX')
                collection[x].checked = aChecked;
        }
    }
    checkByParent('respid', false);
// </script>

// <script type="text/javascript">

    function locationsCheck(aId, aChecked) {
        var collection = document.getElementById(aId).getElementsByTagName('INPUT');
        for (var x=0; x<collection.length; x++) {
            if (collection[x].type.toUpperCase()=='CHECKBOX')
                collection[x].checked = aChecked;
        }
    }
    locationsCheck('locid', false);
// </script>