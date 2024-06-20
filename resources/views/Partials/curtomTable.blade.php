<script src="{{ asset('demo/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('demo/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('demo/js/demo/datatables-demo.js') }}""></script>

<script>
    $('table').dataTable({
        searching: true,
        paging: true,
        info: false
    });
</script>
