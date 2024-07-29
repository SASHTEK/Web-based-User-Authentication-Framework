<!-- Search function -->

<script>
    function searchTable(tableId) {
        const input = document.getElementById("mysearch");
        const filter = input.value.toUpperCase();
        const table = document.getElementById(tableId);
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            if (i === 0) continue;

            const tds = rows[i].getElementsByTagName("td");
            let found = false;

            for (let j = 0; j < tds.length; j++) {
                const txtValue = tds[j].textContent || tds[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }

            rows[i].style.display = found ? "" : "none";
        }
    }
</script>

<!-- Export to Excel -->

<Script>
function exportToExcel(tableId, filename) {
    const table = document.getElementById(tableId);
    const rows = table.getElementsByTagName('tr');
    const data = [];

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.getElementsByTagName('td');
        const rowData = [];

        for (let j = 0; j < cells.length; j++) {
            rowData.push(cells[j].innerText);
        }

        data.push(rowData.join('\t')); // Use tab as delimiter
    }

    const blob = new Blob([data.join('\n')], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8' });
    const url = URL.createObjectURL(blob);

    const link = document.createElement('a');
    link.href = url;
    link.download = filename + '.xlsx'; // Change the extension to .xlsx
    link.click();

    // Clean up
    URL.revokeObjectURL(url);
}
</Script>

<!-- exportToExcel('myTable', 'user_data'); -->

