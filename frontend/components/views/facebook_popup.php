<?php
$this->registerJs("setTimeout(function() { $('#facebook-modal').modal('show');}, 4000);", yii\web\View::POS_END);
$this->registerJs("(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = \"//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=227927380917689\";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));", yii\web\View::POS_HEAD);
?>
<div id="fb-root"></div>

<div class="modal fade" id="facebook-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Like Our Facebook Page</h4>
            </div>
            <div class="modal-body">
                <div class="facebook-page">
                    <div class="fb-page" data-href="https://www.facebook.com/mymovietravel" data-width="300"
                         data-small-header="false" data-hide-cover="false"
                         data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/mymovietravel" class="fb-xfbml-parse-ignore"><a
                                href="https://www.facebook.com/mymovietravel">My Movie Travel</a></blockquote>
                    </div><!---->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Already Liked</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
