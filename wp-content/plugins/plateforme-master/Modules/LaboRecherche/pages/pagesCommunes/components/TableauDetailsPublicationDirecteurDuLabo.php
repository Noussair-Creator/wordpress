<!-- User-provided styles combined into one block -->
<style>
.content-block {
    margin: 20px 0;
    background: #fff;
    border-radius: 10px;
    padding: 34px;
    font-family: 'Segoe UI', sans-serif;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.styled-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 10px;
    box-shadow: 0 0 0 1px #ddd;
    background: #fff;
    font-family: 'Segoe UI', sans-serif;
}

.styled-table thead {
    background-color: #f3f1e9;
}

.styled-table th,
.styled-table td {
    padding: 14px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.styled-table tr:last-child td {
    border-bottom: none;
}

#candidaturesTable thead tr:first-child th:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
}

#candidaturesTable thead tr:first-child th:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
}
</style>


<div class="content-block">
    <table id="candidaturesTable" class="styled-table display">
        <thead>
            <tr>
                <th>Ref_Doc</th>
                <th>fichier</th>
                <th>Télécharger</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>001</td>
                <td>Deeplearning_BCI_Systems.Pdf</td>
                <td>
                    <img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                        alt="upload-red.png">
                </td>
            </tr>
            <tr>
                <td>002</td>
                <td>Poster_Bci2025.Pdf</td>
                <td><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png"
                        alt="upload-red.png"></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Scripts specific to this table component -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ensure DataTables is loaded before trying to initialize it
    if ($.fn.dataTable) {
        $('#candidaturesTable').DataTable({
            paging: false,
            searching: false,
            ordering: false,
            info: false,
            language: {
                emptyTable: "Aucune donnée disponible"
            }
        });
    }
});
</script>