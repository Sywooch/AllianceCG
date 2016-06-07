   function printPage(creditCalendar) {
       var printContents = document.getElementById('creditCalendar').innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = "<html><head><title></title></head><body>" + printContents + "</body>";
       window.print();
       document.body.innerHTML = originalContents;
   }