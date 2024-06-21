$(document).ready(function() {
    $('#orderSelect, #timeFilterSelect').on('change', function() {
        let order = $('#orderSelect').val();
        let timeFilter = $('#timeFilterSelect').val();

        $.ajax({
            url: '/sales-report',
            type: 'GET',
            data: {
                order: order,
                time_filter: timeFilter
            },
            success: function(response) {
                $('#salesTableBody').empty();
                response.sales.forEach(function(sale) {
                    let row = `
                        <tr>
                            <td>${sale.id}</td>
                            <td>${sale.created_at}</td>
                            <td>${sale.total}</td>
                            <td>${sale.quantity}</td>
                        </tr>
                    `;
                    $('#salesTableBody').append(row);
                });
            }
        });
    });

    $('#orderSelect').trigger('change');
});
