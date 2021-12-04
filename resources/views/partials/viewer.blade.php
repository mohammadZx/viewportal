<div class="container-fluid viewer-container-l active">
   <div class=row id=main>
      <section class="col-md-12 scrollmenu" id=scrollmenu>
         <div class=rangs>
            <label for=customRange style=width:100%>Brightness :
            <span class=eng style=color:#fff id=Brightness_value>0</span>
            %
            <button type=button onclick=Brightness_reset() class="btn btn-primary">
            <i class="fa fa-undo"></i>
            </button></label>
            <input type=range class=custom-range id=br name=br min=0 max=200 value=100 onchange=editImage()>
         </div>
         <div class=rangs>
            <label for=customRange2 style=width:100%>Contrast :
            <span style=color:#fff class=eng id=Contrast_value>0</span>
            %
            <button type=button onclick=Contrast_reset() class="btn btn-primary">
            <i class="fa fa-undo"></i></button></label>
            <input type=range class=custom-range id=ct name=ct min=0 max=200 value=100 onchange=editImage()>
         </div>

         <input type=hidden id=invert value=0>
         <img class="icon-tools no-mobile" src=https://hormozdi.github.io/viewer/img/icon/Zoom.png data-enable=inline data-method=reset onclick=magnify(1) title="Magnifier Glass" id=magnifyicon>
         <img class=icon-tools src=https://hormozdi.github.io/viewer/img/icon/ZoomIn.png data-arguments=[0.5] data-enable=inline data-method=zoom title="Zoom in">
         <img class=icon-tools src=https://hormozdi.github.io/viewer/img/icon/ZoomOut.png data-arguments=[-0.5] data-enable=inline data-method=zoom title="Zoom out">
         <img class=icon-tools src=https://hormozdi.github.io/viewer/img/icon/OneToOne.png id=oneonone data-enable=inline data-method=toggle title="One To One">
         <img class=icon-tools src=https://hormozdi.github.io/viewer/img/icon/RotateClock.png data-arguments=[90] data-enable=inline data-method=rotate title="Rotate right" id=rotateright>
         <img class="icon-tools disabaled" src=https://hormozdi.github.io/viewer/img/icon/RotateClock.png title="Rotate right" id=rotateright_disabaled>
         <img class=icon-tools src=https://hormozdi.github.io/viewer/img/icon/RotateCounterClock.png data-arguments=[-90] data-enable=inline data-method=rotate title="Rotate left" id=rotateleft>
         <img class="icon-tools disabaled" src=https://hormozdi.github.io/viewer/img/icon/RotateCounterClock.png title="Rotate left" id=rotateleft_disabaled>
         <img class=icon-tools src=https://hormozdi.github.io/viewer/img/icon/Reverse.png id=fliph data-arguments=[-1] data-enable=inline data-method=scaleX title="Flip horizontal" onclick=fliph()>
         <img class="icon-tools disabaled" src=https://hormozdi.github.io/viewer/img/icon/Reverse.png id=fliph_disabaled title="Flip horizontal">
         <img class=icon-tools src=https://hormozdi.github.io/viewer/img/icon/Flip.png data-arguments=[-1] data-enable=inline data-method=scaleY title="Flip vertical" id=flipv onclick=flipv()>
         <img class="icon-tools disabaled" src=https://hormozdi.github.io/viewer/img/icon/Flip.png title="Flip vertical" id=flipv_disabaled>
         <img class=icon-tools src=https://hormozdi.github.io/viewer/img/icon/InvertColor.png onclick=invertfunc() title="Invert Color" id=inverticon>
         <img class=icon-tools src=https://hormozdi.github.io/viewer/img/icon/Reload.png data-enable=inline data-method=reset id=reset title=Reset>
         <button class="btn btn-primary closev"><i class="fa fa-window-close" aria-hidden="true"></i></button>
         <button class="btn btn-primary printv"><i class="fa fa-print" aria-hidden="true"></i></button>
        </section>
        
      <section class=col-md-12 id=imageview style=height:100%;background-color:#000>
         <div class=docs-galley id=docs-pictures style=margin-bottom:5px!important>
            <ul class="docs-pictures clearfix">
               <li id=imgli></li>
            </ul>
         </div>
      </section>
   </div>
</div>
<script src=https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js></script>
<script src="https://hormozdi.github.io/viewer/content/js/main.js?v=51"></script>
<script src="https://hormozdi.github.io/viewer/viewer/js/viewer.js?v=51"></script>