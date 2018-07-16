@if(session('status'))
    <div style="position: fixed;bottom: 0;left: 20px;" class="animated fadeInLeft div-alert-success">
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('status')}}
        </div>
    </div>
    <script>
        setTimeout(function(){
            console.log(1);
            $('.div-alert-success').addClass('fadeOutLeft');
        },3000)
    </script>
@endif