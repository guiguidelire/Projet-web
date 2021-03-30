
var entreprises;
var tbody;
var rows;
var rowCount = 0;
var pageSize = 12;
var pageIndex = 0;
var pages = 0;

function init(){
        // entreprises = document.getElementsByClassName("entreprises");
        //tbody = entreprises.getElementsByClassName("tableBody");
        console.log("test");
        rows = document.getElementsByClassName("rows");
        
        rowCount = rows.length;
        console.log(rowCount);
        pages = Math.ceil(rowCount / pageSize);
        
        for ( var i=1; i <= pages; i++){
                var paging = document.getElementById("paging");
                paging.innerHTML += " <span onclick='selectPage(" + i + ");'><button>" + i + "</button></span>";
        }
}

function selectPage(pageIndex){
        var current = (pageSize * (pageIndex - 1));
        var next = current + pageSize;
        
        for (var idx =0; idx < current; idx++){
                rows[idx].style.display ='none';
        }
        
        
        for (var idx = current; idx < next; idx++){
                rows[idx].style.display = '';
        }
        
        
        for (var idx = next; idx < rowCount; idx++){
                rows[idx].style.display ='none';
        }
}
