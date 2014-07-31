@extends('show.layout.master')

@section('content')

	<div class="clearfix"></div>
        <div id="card" style="width: 280px; height: 400px; margin-left: auto; margin-right: auto; 
             padding-left: 20px; padding-right: 20px; padding-top: 20px; padding-bottom: 60px;
             text-align: right; color: #FFFFFF; font-family: MyriadPro-SemiCn; font-size: 16px;">
            <?php
            if($argument->layout == 1){
            ?>
                <div style="height: 400px; width: 280px; margin-left: auto; margin-right: auto;
                     background-repeat: no-repeat; background-image: url('<?php echo asset('img/cards/'.$argument->img) ?>')">
                    <div style="width: 160px; height: 150px; text-align: right; margin-left: 65px;">
                        {{ $argument->name }}
                    </div>
                    <div style="width: 280px; height: 175px;"></div>
                    <div style="width: 250px; height: 25px; margin-top: 10px;
                            font-size: 11px !important;
                            text-align: center; color: <?php echo $argument->industry->txt_color ?>">
                        {{ $argument->source }}
                    </div>
                </div>
            <?php
            }
            if($argument->layout == 2){
            ?>
                <div style="height: 400px; width: 280px; margin-left: auto; margin-right: auto;
                     background-repeat: no-repeat; background-image: url('<?php echo asset('img/cards/'.$argument->img) ?>')">
                    <div style="width: 280px; height: 175px;"></div>
                    <div style="width: 155px; height: 150px; text-align: left; margin-left: 25px;">
                        {{ $argument->name }}
                    </div>
                    <div style="width: 250px; height: 25px; margin-top: 10px;
                            font-size: 11px !important;
                            text-align: center; color: <?php echo $argument->industry->txt_color ?>">
                        {{ $argument->source }}
                    </div>
                </div>
            <?php
            }
            if($argument->layout == 3){
            ?>
                <div style="height: 400px; width: 280px; margin-left: auto; margin-right: auto;">
                    <div style="width: 100px; height: 200px; 
                         text-align: right; float: right; margin-right: 50px;">
                        {{ $argument->name }}
                    </div>
                    <div style="width: 280px; height: 285px; margin-bottom: 50px;
                         background-repeat: no-repeat; background-image: url('<?php echo asset('img/cards/'.$argument->img) ?>')">
                    </div>
                    <div style="width: 250px; height: 25px; margin-top: 10px;
                            font-size: 11px !important;
                            text-align: center; color: <?php echo $argument->industry->txt_color ?>">
                        {{ $argument->source }}
                    </div>
                </div>
            <?php
            }
            if($argument->layout == 4){
            ?>
                <div style="height: 400px; width: 280px; margin-left: auto; margin-right: auto;">
                    <div style="width: 280px; height: 285px; margin-bottom: 50px;
                         background-repeat: no-repeat; background-image: url('<?php echo asset('img/cards/'.$argument->img) ?>')">
                    </div>
                    <?php
                        if(strlen($argument->name)<70){ $paddingtop = "padding-top: 75px;"; }
                        else if (strlen($argument->name)<=90){ $paddingtop = "padding-top: 65px;"; }
                        else if (strlen($argument->name)<=105){ $paddingtop = "padding-top: 30px;"; }
                        else if (strlen($argument->name)>105){ $paddingtop = "padding-top: 0px;"; }
                    ?>
                    <div style="width: 100px; height: 100px; 
                         text-align: right; float: right; margin-right: 50px; margin-top: -235px; <?php echo $paddingtop ?>">
                        {{ $argument->name }}
                    </div>
                    <div style="width: 280px; height: 25px; margin-top: 10px;
                            font-size: 11px !important;
                            text-align: center; color: <?php echo $argument->industry->txt_color ?>">
                        {{ $argument->source }}
                    </div>
                </div>
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