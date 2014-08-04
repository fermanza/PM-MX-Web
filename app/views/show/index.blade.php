@extends('show.layout.master')

@section('content')

	<div class="clearfix"></div>
        <div id="card" style="width: 280px; height: 400px; margin-left: auto; margin-right: auto; 
                text-align: right; color: #FFFFFF;
                font-family: MyriadPro-SemiCn; font-size: 17px;
                overflow:hidden;">
            <?php
                $pattern = "<b>";
                $txt_color = $argument->industry->txt_color;
                $replacement = "<b style='color: $txt_color;'>";
                $argument->name = str_replace($pattern, $replacement, $argument->name);
            
            if($argument->layout == 1){
            ?>
                <div style="width: 280px; height: 400px; margin-left: auto; margin-right: auto;
                     background-repeat: no-repeat;
                     background-image: url('<?php echo asset('img/cards/'.$argument->img) ?>')">
                    <?php
                    $attr = "width: 160px;";
                    if(strlen($argument->name)<70){ $attr = "width: 160px;"; }
                    else if (strlen($argument->name)<=100){ $attr = "width: 170px;"; }
                    else if (strlen($argument->name)<=120){ $attr = "width: 180px;"; }
                    else if (strlen($argument->name)<=135){ $attr = "width: 190px;"; }
                    else if (strlen($argument->name)>135){ $attr = "width: 210px;"; }
                    ?>
                    <div style="<?php echo $attr; ?> height: 325px; text-align: right; margin-left: 65px;">
                        {{ $argument->name }}
                    </div>
                    <div class="clearfix"></div>
                    <div style="width: 280px; height: 25px; margin-top: 5px;
                            font-size: 12px !important;
                            text-align: center; color: <?php echo $argument->industry->txt_color ?>">
                        Fuente: {{ $argument->source }}
                    </div>
                </div>
            <?php
            }
            if($argument->layout == 2){
            ?>
                <div style="width: 280px; height: 400px; margin-left: auto; margin-right: auto;
                     background-repeat: no-repeat; background-image: url('<?php echo asset('img/cards/'.$argument->img) ?>')">
                    <div style="width: 280px; height: 175px;"></div>
                    <?php
                    $attr = "width: 155px; padding-top: 25px;";
                    if(strlen($argument->name)<70){ $attr = "width: 155px; padding-top: 25px;"; }
                    else if (strlen($argument->name)<=120){ $attr = "width: 175px; padding-top: 25px;"; }
                    else if (strlen($argument->name)<=150){ $attr = "width: 185px; padding-top: 25px;"; }
                    else if (strlen($argument->name)>150){ $attr = "width: 195px; padding-top: 15px;"; }
                    ?>
                    <div style="width: <?php echo $attr; ?> height: 150px; text-align: left;
                         margin-left: 5px; margin-right: 5px;">
                        {{ $argument->name; }}
                    </div>
                    <div class="clearfix"></div>
                    <div style="width: 280px; height: 25px; margin-top: 5px;
                            font-size: 12px !important;
                            text-align: center; color: <?php echo $argument->industry->txt_color ?>">
                        Fuente: {{ $argument->source }}
                    </div>
                </div>
            <?php
            }
            if($argument->layout == 3){
            ?>
                <div style="width: 280px; height: 400px; margin-left: auto; margin-right: auto;">
                    <?php
                    $attr = "width: 100px;";
                    if(strlen($argument->name)<70){ $attr = "width: 100px;"; }
                    else if (strlen($argument->name)<=100){ $attr = "width: 110px;"; }
                    else if (strlen($argument->name)<=120){ $attr = "width: 120px;"; }
                    else if (strlen($argument->name)>130){ $attr = "width: 130px;"; }
                    ?>
                    <div style="<?php echo $attr; ?> height: 200px; 
                         text-align: right; float: right; margin-right: 50px;">
                        {{ $argument->name }}
                    </div>
                    <div style="width: 280px; height: 285px; margin-bottom: 50px;
                         background-repeat: no-repeat;
                         background-image: url('<?php echo asset('img/cards/'.$argument->img) ?>')">
                    </div>
                    <div class="clearfix"></div>
                    <div style="width: 280px; height: 25px; margin-top: 5px;
                            font-size: 12px !important;
                            text-align: center; color: <?php echo $argument->industry->txt_color ?>">
                        Fuente: {{ $argument->source }}
                    </div>
                </div>
            <?php
            }
            if($argument->layout == 4){
            ?>
                <div style="width: 280px; height: 400px; margin-left: auto; margin-right: auto;">
                    <div style="width: 280px; height: 285px; margin-bottom: 50px;
                         background-repeat: no-repeat;
                         background-image: url('<?php echo asset('img/cards/'.$argument->img) ?>')">
                    </div>
                    <?php
                        $attr = "padding-top: 85px; width: 110px;";
                        if(strlen($argument->name)<80){ $attr = "padding-top: 90px; width: 115px;"; }
                        else if (strlen($argument->name)<=105){ $attr = "padding-top: 80px; width: 120px;"; }
                        else if (strlen($argument->name)<=125){ $attr = "padding-top: 65px; width: 125px;"; }
                        else if (strlen($argument->name)>125){ $attr = "padding-top: 25px; width: 130px;"; }
                    ?>
                    <div style="<?php echo $attr ?> height: 100px;
                         text-align: right; float: right; margin-right: 50px; margin-top: -235px;">
                        {{ $argument->name }}
                    </div>
                    <div class="clearfix"></div>
                    <div style="width: 280px; height: 25px; margin-top: 5px;
                            font-size: 12px !important;
                            text-align: center; color: <?php echo $argument->industry->txt_color ?>">
                        Fuente: {{ $argument->source }}
                    </div>
                </div>
            <?php
            }
            ?>
            <div>{{ $argument->url_image }}</div>
        </div>
        
<script type="text/javascript">
    document.getElementById('card').style.backgroundColor="<?php echo $argument->industry->bg_color; ?>";
</script>
@endsection