


<script>

    $(".hidder").click(function (){
        var obj = $(this).attr("object");
        $("."+obj).toggle();
        var status = $("."+obj).css("display");
        console.log(status);

        $.ajax({
            url: '/gPOUsers/bindGPtoUser', //роут незаметный
            method: 'post',
            data: {param: obj, action: status}
        });


    });

</script>

<footer class="footer">
    <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Devcluster 2021</span>
    </div>
</footer>