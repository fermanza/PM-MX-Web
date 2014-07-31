@extends('show.layout.master')

@section('content')

	<div class="clearfix"></div>
        <div id="card" style="width: 280px; height: 400px; margin-left: auto; margin-right: auto; 
             padding-left: 40px; padding-right: 45px; padding-top: 20px; padding-bottom: 60px;
             text-align: right; color: #FFFFFF; font-family: MyriadPro-SemiCn; font-size: 15px;">
            <?php
            if($argument->layout == 1){
            ?>
                <div>
                    <div style="width: 200px; height: 280px; text-wrap:none;">{{ $argument->name }}
                    <img src=<?php echo asset('img/cards/'.$argument->img) ?> alt="" 
                         style="position: relative;">
                    </div>

                    <div style="width: 220px; height: 50px; 
                            text-wrap:none; font-size: 10px !important;
                            text-align: center; color: <?php echo $argument->industry->txt_color ?>">
                        {{ $argument->source }}
                    </div>
                </div>
            <?php
            }
            if($argument->layout == 2){
            ?>
            
            <?php
            }
            if($argument->layout == 3){
            ?>
            
            <?php
            }
            if($argument->layout == 4){
            ?>
            
            <?php
            }
            ?>
            <div>{{ $argument->url_image }}</div>
        </div>
        
<script type="text/javascript">
    document.getElementById('card').style.backgroundColor="<?php echo $argument->industry->bg_color; ?>"; 
    document.getElementById('card').style.backgroundColor="<?php echo $argument->industry->bg_color; ?>"; 
</script>
@endsection