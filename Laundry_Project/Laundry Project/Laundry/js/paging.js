 var theTable = document.getElementById("laundryScheduleTable");
 var totalPage = document.getElementById("totalPage");
 var pageNum = document.getElementById("pageNum");

 var numberRowsInTable = theTable.rows.length;
 var pageSize = 15;
 var page = 1;

 function next() {
     hideTable();

     currentRow = pageSize * page;
     maxRow = currentRow + pageSize;
     if (maxRow > numberRowsInTable) maxRow = numberRowsInTable;
     for (var i = currentRow; i < maxRow; i++) {
         theTable.rows[i].style.display = '';
     }
     page++;

     if (maxRow == numberRowsInTable) { 
		disableButton("buttonNext");
		disableButton("buttonLast");
	}
     showPage();
     enableButton("buttonPre");
     enableButton("buttonFirst");
 }

 function pre() {
     hideTable();
     page--;

     currentRow = pageSize * page;
     maxRow = currentRow - pageSize;
     if (currentRow > numberRowsInTable) currentRow = numberRowsInTable;
     for (var i = maxRow; i < currentRow; i++) {
         theTable.rows[i].style.display = '';
     }

     if (maxRow == 0) { 
		disableButton("buttonPre");
		disableButton("buttonFirst"); 
	 }
     showPage();
     enableButton("buttonNext");
     enableButton("buttonLast");
 }

 function first() {
     hideTable();
     page = 1;
     for (var i = 0; i < pageSize; i++) {
         theTable.rows[i].style.display = '';
     }
     showPage();
	

	disableButton("buttonFirst");
	disableButton("buttonPre");
    enableButton("buttonNext");
    enableButton("buttonLast");
 }

 function last() {
     hideTable();
     page = pageCount();
     currentRow = pageSize * (page - 1);
     for (var i = currentRow; i < numberRowsInTable; i++) {
         theTable.rows[i].style.display = '';
     }
     showPage();

	enableButton("buttonFirst");
	enableButton("buttonPre");
	disableButton("buttonNext");
	disableButton("buttonLast");
 }

 function hideTable() {
     for (var i = 0; i < numberRowsInTable; i++) {
         theTable.rows[i].style.display = 'none';
     }
 }

 function showPage() {
     pageNum.innerHTML = page;
 }

 function pageCount() {
     var count = 0;
     if (numberRowsInTable % pageSize != 0) count = 1;
     return parseInt(numberRowsInTable / pageSize) + count;
 }

 function enableButton(bn) {
	document.getElementById(bn).disabled=false; 
	document.getElementById(bn).style.color="#fff"
 }
 
 function disableButton(bn) {
	document.getElementById(bn).disabled=true; 
	document.getElementById(bn).style.color="#483D8B"
 }

 function hide() {
     for (var i = pageSize; i < numberRowsInTable; i++) {
         theTable.rows[i].style.display = 'none';
     }


     var pc = pageCount();
	 totalPage.innerHTML = pc;
     pageNum.innerHTML = '1';
	 
	 if(pc == 1){
		disableButton("buttonFirst");
		disableButton("buttonPre");
		disableButton("buttonNext");
		disableButton("buttonLast");
	 }else{
		disableButton("buttonFirst");
		disableButton("buttonPre");
		enableButton("buttonNext");
		enableButton("buttonLast");
	 }
 }

 hide();