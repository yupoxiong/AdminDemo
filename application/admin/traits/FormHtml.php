<?php

namespace app\admin\traits;

trait FormHtml
{

    public $checkboxHtml = <<<EOF
<div class="form-group">
    <label class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="[FIELD_NAME][]" class="field-checkbox"> [FORM_NAME]
            </label>
        </div>
    </div>
</div>\n
EOF;


    public $colorHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <div class="input-group" id="color-[FIELD_NAME]">
            <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请输入[FORM_NAME]" type="text" class="form-control field-map">
            <div class="input-group-addon"><i></i></div>
        </div>
    </div>
</div>
<script>
    $('#color-[FIELD_NAME]').colorpicker();
</script>\n
EOF;


    public static $dateHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请选择[FORM_NAME]" type="text" class="form-control filed-date">
    </div>
</div>
<script>
    laydate.render({
        elem: '#[FIELD_NAME]',
    });
</script>\n
EOF;


    public static $dateRangeHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请选择[FORM_NAME]" type="text" class="form-control filed-date-range">
    </div>
</div>
<script>
    laydate.render({
        elem: '#[FIELD_NAME]',
        range: true
    });
</script>\n
EOF;


    public static $datatimeHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请选择[FORM_NAME]" type="text" class="form-control filed-datetime">
    </div>
</div>
<script>
    laydate.render({
        elem: '#[FIELD_NAME]',
        type: 'datetime',
    });
</script>\n
EOF;


    public static $datetimeRangeHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请选择[FORM_NAME]" type="text" class="form-control filed-datetime-range">
    </div>
</div>
<script>
    laydate.render({
        elem: '#[FIELD_NAME]',
        type: 'datetime',
        range: true,
    });
</script>\n
EOF;


    public static $EditorHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
        <div class="col-sm-10">
            <script id="[FIELD_NAME]" name="[FIELD_NAME]" type="text/plain">{\$data.[FIELD_NAME]|raw|default='[FIELD_DEFAULT]'}</script>
        </div>
    </div>
<script>
    UE.delEditor('[FIELD_NAME]');
    var UE_[FIELD_NAME] = UE.getEditor('[FIELD_NAME]',{
        serverUrl :UEServer
    });
</script>\n
EOF;


    public static $emailhtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请输入[FORM_NAME]" type="email" class="form-control field-email">
    </div>
</div>\n
EOF;


    public static $fileHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4"> 
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" data-initial-preview="{\$data.[FIELD_NAME]|default=''}" placeholder="请上传[FORM_NAME]" type="file" class="form-control field-file" >
    </div>
</div>
<script>
    $('#[FIELD_NAME]').fileinput({
        language: 'zh',
        browseLabel: '浏览',
        initialPreviewAsData: false,
        dropZoneEnabled: false,
        showUpload:false,
        showRemove: false,
        allowedFileExtensions: ['jpg', 'png', 'gif','bmp','svg','jpeg','mp4','doc','docx','pdf','xls','xlsx','ppt','pptx','txt'],
        maxFileSize:10240
    });
</script>\n
EOF;


    public static $iconHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <div class="input-group iconpicker-container">
            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
            <input maxlength="30" id="[FIELD_NAME]" name="[FIELD_NAME]"
                   value="[FIELD_CONTENT]" class="form-control "
                   placeholder="请选择[FORM_NAME]">
        </div>
    </div>
</div>
<script>
    $('#[FIELD_NAME]').iconpicker({placement: 'bottomLeft'});
</script>\n
EOF;


    public static $idCardHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请输入[FORM_NAME]" type="text" maxlength="18" class="form-control field-id-card">
    </div>
</div>\n
EOF;

    public static $iamgeHtml = <<<EOF
    <div class="form-group">
        <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
        <div class="col-sm-10 col-md-4"> 
            <input id="[FIELD_NAME]" name="[FIELD_NAME]"  placeholder="请上传[FORM_NAME]" data-initial-preview="{\$data.[FIELD_NAME]|default=''}" type="file" class="form-control field-image" >
        </div>
    </div>
    <script>
    $('#[FIELD_NAME]').fileinput({
        language: 'zh',
        overwriteInitial: true,
        browseLabel: '浏览',
        initialPreviewAsData: true,
        dropZoneEnabled: false,
        showUpload:false,
        showRemove: false,
        allowedFileTypes:['image'],
        maxFileSize:10240,
    });
    </script>\n
EOF;


    public static $ipHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请输入[FORM_NAME]" type="text" class="form-control field-map">
    </div>
</div>\n
EOF;


    public static $ampHtml = <<<EOF
    
<div class="form-group">
    <label class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-8 ">
        <div id="map-container" style="width: 100%; height: 350px;position: relative; background-color: rgb(229, 227, 223);overflow: hidden;transform: translateZ(0px);">
        </div>
        <input name="[FIELD_NAME_LNG]" hidden id="[FIELD_NAME_LNG]" value="{\$data.[FIELD_NAME_LNG]|default='[FIELD_DEFAULT_LNG]'}">
        <input name="[FIELD_NAME_LAT]" hidden id="[FIELD_NAME_LAT]" value="{\$data.[FIELD_NAME_LAT]|default='[FIELD_DEFAULT_LAT]'}" >
    </div>
</div>
    
<script>
    AMapUI.loadUI(['misc/PositionPicker'], function(PositionPicker) {
        var map = new AMap.Map('map-container', {
            zoom: 16,
            scrollWheel: true
        })
        var positionPicker = new PositionPicker({
            mode: 'dragMap',
            map: map
        });

        positionPicker.on('success', function(positionResult) {
            console.log(positionResult);
            console.log('success');
            $('#[FIELD_NAME_LNG]').val(positionResult.position.lng);
            $('#[FIELD_NAME_LAT]').val(positionResult.position.lat);
        });
        positionPicker.on('fail', function(positionResult) {
            console.log(positionResult);
        });
        positionPicker.start( 
            {if isset(\$data)}
            new AMap.LngLat({\$data.[FIELD_NAME_LNG]}, {\$data.[FIELD_NAME_LAT]})
            {/if}
            ); 
        map.panBy(0, 1);
        map.addControl(new AMap.ToolBar({
            liteStyle: true
        }))
    });
</script>\n
EOF;


    public static $mobileHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请输入[FORM_NAME]" type="tel" maxlength="11" class="form-control field-mobile">
    </div>
</div>\n
EOF;


    public static $multiFileHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-8"> 
        <input id="[FIELD_NAME]" name="[FIELD_NAME]"  placeholder="请上传[FORM_NAME]" type="file" class="form-control field-multi-file" >
    </div>
</div>
<script>
    $('#[FIELD_NAME]').fileinput({
        //theme: 'fas',
        language: 'zh',
    
        browseLabel: '浏览',
        initialPreviewAsData: false,
        initialPreviewShowDelete:false,
        dropZoneEnabled: false,
        showUpload:false,
        showRemove: false,
        allowedFileExtensions: ['jpg', 'png', 'gif','bmp','svg','jpeg','mp4','doc','docx','pdf','xls','xlsx','ppt','pptx','txt'],
        {if isset(\$data)}
        initialPreview:{\$data->getData('[FIELD_NAME]')|raw},
        {/if}
        //默认限制10M
        maxFileSize:10240
    });
</script>\n
EOF;


    public static $multiImageHtml = <<<EOF

<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4"> 
        <input id="[FIELD_NAME]" name="[FIELD_NAME][]"  placeholder="请上传[FORM_NAME]" multiple="multiple" type="file" class="form-control field-multi-image" >
    </div>
</div>
<script>
$(function() {
    $('#[FIELD_NAME]').fileinput({
        "initialPreview":false,
        overwriteInitial: true,
        language: 'zh',
        browseLabel: '浏览',
        initialPreviewAsData: true,
        initialPreviewShowDelete:false,
        dropZoneEnabled: false,
        showUpload:false,
        showRemove: false,
        allowedFileTypes:['image'],
        //默认限制10M
        maxFileSize:10240,
        {if isset(\$data)}
        initialPreview:{\$data->getData('[FIELD_NAME]')|raw},
        {/if}
    });
})
</script>\n
EOF;


    public static $multiSelectHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
       
        <select name="[FIELD_NAME][]" id="[FIELD_NAME]" data-placeholder="请选择[FORM_NAME]" class="form-control field-multi-select" multiple="multiple">
            <option value=""></option>
        </select>
    </div>
</div>
<script>
 $('#[FIELD_NAME]').select2();
</script>\n
EOF;


    public static $numberHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
         <div class="input-group">
            <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请输入[FORM_NAME]" type="number" class="form-control field-number">
        </div>
    </div>
</div>
<script>
    $('#[FIELD_NAME]')
        .bootstrapNumber({
            upClass: 'success',
            downClass: 'primary',
            center: true
        });
</script>\n
EOF;


    public static $passwordHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请输入[FORM_NAME]" type="password" class="form-control field-password">
    </div>
</div>\n
EOF;

    public static $radioHtml = <<<EOF
<div class="radio">
    <label>
        <input type="radio" name="[FIELD_NAME]" value="" checked="">
        [FORM_NAME]
    </label>
</div>\n
EOF;


    public static $selectHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <select name="[FIELD_NAME]" id="[FIELD_NAME]" class="form-control field-select" data-placeholder="请选择[FORM_NAME]">
            <option value=""></option>
            [RELATION_DATA]
        </select>
    </div>
</div>
<script>
 $('#[FIELD_NAME]').select2();
</script>\n
EOF;


    public static $switchHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
    <input class="input-switch"  id="[FIELD_NAME]" value="1" {if(!isset(\$data) ||\$data.[FIELD_NAME]==1)}checked{/if} type="checkbox" />
    <input class="switch field-switch" placeholder="[FORM_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" hidden />
    </div>
</div>\n
<script>
    $('#[FIELD_NAME]').bootstrapSwitch({
        onText: "[ON_TEXT]",
        offText: "[OFF_TEXT]",
        onColor: "success",
        offColor: "danger",
        onSwitchChange: function (event, state) {
            $(event.target).closest('.bootstrap-switch').next().val(state ? '1' : '0').change();
        }
    });
</script>
EOF;


    public static $textHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请输入[FORM_NAME]" type="text" class="form-control field-text">
    </div>
</div>\n
EOF;


    public static $textareaHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <textarea id="[FIELD_NAME]" name="[FIELD_NAME]" class="form-control" rows="[ROWS]" placeholder="请输入[FORM_NAME]">[FIELD_CONTENT]</textarea>
    </div>
</div>\n
EOF;


    public static $timeHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请选择[FORM_NAME]" type="text" class="form-control filed-time">
    </div>
</div>
<script>
    laydate.render({
        elem: '#[FIELD_NAME]',
        type: 'time',
    });
</script>\n
EOF;


    public static $timeRangeHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请选择[FORM_NAME]" type="text" class="form-control filed-time-range">
    </div>
</div>
<script>
    laydate.render({
        elem: '#[FIELD_NAME]',
        type: 'time',
        range: true,
    });
</script>\n
EOF;


    public static $urlHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请输入[FORM_NAME]" type="text" class="form-control field-map">
    </div>
</div>\n
EOF;


    public static $yearHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请选择[FORM_NAME]" type="text" class="form-control filed-year">
    </div>
</div>
<script>
    laydate.render({
        elem: '#[FIELD_NAME]',
        type: 'year',
    });
</script>\n
EOF;


    public static $yearMonthHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请选择[FORM_NAME]" type="text" class="form-control filed-year-month">
    </div>
</div>
<script>
    laydate.render({
        elem: '#[FIELD_NAME]',
        type: 'month',
    });
</script>\n
EOF;



    public static $yearMonthRangeHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请选择[FORM_NAME]" type="text" class="form-control filed-year-month-range">
    </div>
</div>
<script>
    laydate.render({
        elem: '#[FIELD_NAME]',
        type: 'month',
        range: true,
    });
</script>\n
EOF;


    public static $yearRangeHtml = <<<EOF
<div class="form-group">
    <label for="[FIELD_NAME]" class="col-sm-2 control-label">[FORM_NAME]</label>
    <div class="col-sm-10 col-md-4">
        <input id="[FIELD_NAME]" name="[FIELD_NAME]" value="[FIELD_CONTENT]" placeholder="请选择[FORM_NAME]" type="text" class="form-control filed-year-range">
    </div>
</div>
<script>
    laydate.render({
        elem: '#[FIELD_NAME]',
        type: 'year',
        range: true,
    });
</script>\n
EOF;


    protected function getFieldForm($type, $name, $field, $value)
    {
        $form = '';
        switch ($type) {
            case 'text':

                $form = '';
                break;

            default:
                $form = '';

                break;
        }


        return $form;
    }

}