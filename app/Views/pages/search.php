<script>
    $(document).ready(function(){
        $("#search_product").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            // console.log(value)
            $("#content div.col-md-3").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>