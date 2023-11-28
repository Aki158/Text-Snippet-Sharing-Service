window.addEventListener("load", (event) => {
    for (var i = 0; i < Object.keys(snippets_table).length; i++) {
        render_table_cell(i,snippets_table,document.getElementById("table_body"));
    }
});

function render_table_cell(index,snippets_table,table_body){
    const row = document.createElement("tr");
    const cell_th_name = document.createElement("th");
    const cell_td_posted = document.createElement("td");
    const cell_td_syntax = document.createElement("td");

    row.setAttribute("id", "table_content"+(index+1));

    cell_th_name.setAttribute("id", "name"+(index+1));
    cell_td_posted.setAttribute("id", "posted"+(index+1));
    cell_td_syntax.setAttribute("id", "syntax"+(index+1));

    cell_th_name.innerHTML = snippets_table[index].name;
    cell_td_posted.innerHTML = snippets_table[index].posted;
    cell_td_syntax.innerHTML = snippets_table[index].syntax;

    row.classList.add("cursor-pointer");
    
    row.addEventListener("click", function() {
        if(snippets_table[index].path !== "None"){
            window.location.href = "snippet.php"+"?path="+snippets_table[index].path;
        }
    });

    row.append(cell_th_name);
    row.append(cell_td_posted);
    row.append(cell_td_syntax);
    table_body.append(row);
}
