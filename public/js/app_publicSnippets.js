window.addEventListener("load", (event) => {
    for (var i = 0; i < Object.keys(snippetsTable).length; i++) {
        renderTableCell(i,snippetsTable,document.getElementById("tableBody"));
    }
});

function renderTableCell(index,snippetsTable,tableBody){
    const row = document.createElement("tr");
    const cellThName = document.createElement("th");
    const cellTdPosted = document.createElement("td");
    const cellTdSyntax = document.createElement("td");

    row.setAttribute("id", "table_content"+(index+1));

    cellThName.setAttribute("id", "name"+(index+1));
    cellTdPosted.setAttribute("id", "posted"+(index+1));
    cellTdSyntax.setAttribute("id", "syntax"+(index+1));

    cellThName.innerHTML = snippetsTable[index].name;
    cellTdPosted.innerHTML = snippetsTable[index].posted;
    cellTdSyntax.innerHTML = snippetsTable[index].syntax;

    row.classList.add("cursor-pointer");
    
    row.addEventListener("click", function() {
        if(snippetsTable[index].path !== "None"){
            window.location.href = "snippet.php"+"?path="+snippetsTable[index].path;
        }
    });

    row.append(cellThName);
    row.append(cellTdPosted);
    row.append(cellTdSyntax);
    tableBody.append(row);
}
