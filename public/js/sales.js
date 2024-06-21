$(document).ready(function() {
    // Función para cargar las ventas según el orden seleccionado
    function loadSales(orderBy) {
        console.log(orderBy);
        $.ajax({
            url: '/sales-report', // Ruta a tu endpoint de ventas en Laravel
            type: 'GET',
            data: { orderBy: orderBy }, // Parámetro opcional para ordenar
            success: function(response) {
                var salesTableBody = $('#salesTableBody');
                salesTableBody.empty();
                
                response.sales.forEach(function(sale) {
                    var row = `<tr>
                        <td>${sale.id}</td>
                        <td>${sale.created_at}</td>
                        <td>${sale.total}</td>
                        <td>${sale.quantity}</td>
                    </tr>`;
                    salesTableBody.append(row);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar las ventas:', error);
            }
        });
    }

    loadSales('created_at');

    $('#orderSelect').change(function() {
        var orderBy = $(this).val();
        loadSales(orderBy);
    });
});