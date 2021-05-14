if(document.getElementById("resultTable")){
    var dataTable = new DataTable("#resultTable", {
        searchable: true,
        fixedHeight: true,
        perPageSelect: [5, 10, 15, 20, 50, 100],
        perPage: 20,
        columns: [
            {
            select: 8, // COLONNE DU BOUTON MORE INFO, on démarre toujours de 0
            sortable: false
            }
        ]
    });
}