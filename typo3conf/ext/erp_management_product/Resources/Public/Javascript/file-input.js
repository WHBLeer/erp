    $("#bootstarp-fileupload").fileinput({
        language: 'zh',
        theme: 'fas',
        uploadUrl: '/api/fileprocessing?cmd=f_upload', 
        showUpload: false,
        allowedFileExtensions : ['jpg', 'png','gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 20,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        },
        showUploadedThumbs : true,
        initialPreviewAsData: true,
        initialPreview:initialPreview,
        initialPreviewConfig:initialPreviewConfig,
        deleteUrl: "/api/fileprocessing?cmd=f_delete"    //删除操作的URL地址
    });
    $('#bootstarp-fileupload').on('change', function(event) {
        console.log("change");
        $('#bootstarp-fileupload').fileinput('upload');
        console.log("upload");
    });

    $("#bootstarp-fileupload").on("fileuploaded", function (event, data, previewId, index) {
        var obj = data.response;
        if (obj.code==1) {
            oval = $("#imageuids").val();
            $("#imageuids").val(oval+','+obj.uid);
            notify(obj.message, "success");
        }else{
            notify(obj.message, "error");
        }
    });
    $('#bootstarp-fileupload').on('fileerror', function(event, data, msg) {
        console.log(data.id);
        console.log(data.index);
        console.log(data.file);
        console.log(data.reader);
        console.log(data.files);
        // 获取信息
        alert(msg);
    });
    $("#bootstarp-fileupload").on('filepreremove', function(event, id, index) {
        console.log(event);
        console.log(id);
        console.log(index);
        // layer.confirm('确定删除文件吗？', {icon: 0, title:'提示'}, function(index){
        //     //do something
        //     layer.close(index);
        // });
    });
    $("#bootstarp-fileupload").on('filepredelete', function(event, key, jqXHR, data) {
        // layer.confirm('确定删除原文件？删除后不可恢复', {icon: 0, title:'提示'}, function(index){
            console.log('Key = ' + key);  
            console.log(jqXHR);  
            console.log(data);   
            // layer.close(index);
        // });
    });
    $("#bootstarp-fileupload").on('filedeleted', function(event, key) {
        notify('图片已删除！',"success");
    });
    $('#bootstarp-fileupload').on('filezoomshow', function(event, params) {
        console.log(params);
        console.log('File zoom show ', params.sourceEvent, params.previewId, params.modal);
    });
    $('#bootstarp-fileupload').on('change', function(event) {
        console.log("change");
    });
    
    /*
    * 鼠标放在图片上方，显示大图
    */
    var img_show = null; // tips提示
    $('.image-view').hover(function(){
        var img = "<img class='img_msg' src='"+$(this).attr('src')+"' style='width:470px;border:1px solid #ccc;border-radius:5px' />";
        img_show = layer.tips(img, this, {
            tips: [2, '#fff'],
            area: ['500px'],
            times: 0
        });
    },function(){
        layer.close(img_show);
    });
        